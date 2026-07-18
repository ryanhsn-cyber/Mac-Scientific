<?php

namespace App\Http\Controllers\Back;

use App\{
    Models\Order,
    Models\PromoCode,
    Models\TrackOrder,
    Http\Controllers\Controller
};
use App\Helpers\SmsHelper;
use App\Models\Notification;
use Carbon\Carbon;
use Illuminate\Http\Request;

class OrderController extends Controller
{

    /**
     * Constructor Method.
     *
     * Setting Authentication
     *
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
        $this->middleware('adminlocalize');
    }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
      
        if($request->type){
            if($request->start_date && $request->end_date){
                $datas = $start_date = Carbon::parse($request->start_date);
                $end_date = Carbon::parse($request->end_date);
                $datas = Order::latest('id')->whereOrderStatus($request->type)->whereDate('created_at','>=',$start_date)->whereDate('created_at','<=',$end_date)->get();
            }else{
                $datas = Order::latest('id')->whereOrderStatus($request->type)->get();
            }
            
        }else{
            if($request->start_date && $request->end_date){
                $datas = $start_date = Carbon::parse($request->start_date);
                $end_date = Carbon::parse($request->end_date);
                $datas = Order::latest('id')->whereDate('created_at','>=',$start_date)->whereDate('created_at','<=',$end_date)->get();
            }else{
                $datas = Order::latest('id')->get();
            }
        }
        return view('back.order.index',compact('datas'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function invoice($id)
    {
        $order = Order::findOrfail($id);
        $cart = json_decode($order->cart, true);
        return view('back.order.invoice',compact('order','cart'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function printOrder($id)
    {
        $order = Order::findOrfail($id);
        $cart = json_decode($order->cart, true);
        return view('back.order.print',compact('order','cart'));
    }


    /**
     * Change the status for editing the specified resource.
     *
     * @param  int  $id
     * @param  string  $field
     * @param  string  $value
     * @return \Illuminate\Http\Response
     */
    public function status($id,$field,$value)
    {

        $order = Order::find($id);
        if($field == 'payment_status'){
            if($order['payment_status'] == 'Paid'){
                return redirect()->route('back.order.index')->withErrors(__('Order is already paid.'));
            }
        }
        if($field == 'order_status'){
            if($order['order_status'] == 'Delivered'){
                return redirect()->route('back.order.index')->withErrors(__('Order is already Delivered.'));
            }
        }
        $order->update([$field => $value]);
        if($order->payment_status == 'Paid'){
            $this->setPromoCode($order);
        }
        $this->setTrackOrder($order);
        $sms = new SmsHelper();
        $user_number = $order->user->phone;
        if($user_number){
            $sms->SendSms($user_number,"'order_status'",$order->transaction_number);
        }
       
        return redirect()->route('back.order.index')->withSuccess(__('Status Updated Successfully.'));
    }

    /**
     * Custom Function
     */
    public function setTrackOrder($order)
    {

        if($order->order_status == 'In Progress'){
            if(!TrackOrder::whereOrderId($order->id)->whereTitle('In Progress')->exists()){
                TrackOrder::create([
                    'title' => 'In Progress',
                    'order_id' => $order->id
                ]);
            }
        }
        if($order->order_status == 'Canceled'){
            if(!TrackOrder::whereOrderId($order->id)->whereTitle('Canceled')->exists()){

                if(!TrackOrder::whereOrderId($order->id)->whereTitle('In Progress')->exists()){
                    TrackOrder::create([
                        'title' => 'In Progress',
                        'order_id' => $order->id
                    ]);
                }
                if(!TrackOrder::whereOrderId($order->id)->whereTitle('Delivered')->exists()){
                    TrackOrder::create([
                        'title' => 'Delivered',
                        'order_id' => $order->id
                    ]);
                }

                if(!TrackOrder::whereOrderId($order->id)->whereTitle('Canceled')->exists()){
                    TrackOrder::create([
                        'title' => 'Canceled',
                        'order_id' => $order->id
                    ]);
                }


            }
        }

        if($order->order_status == 'Delivered'){

            if(!TrackOrder::whereOrderId($order->id)->whereTitle('In Progress')->exists()){
                TrackOrder::create([
                    'title' => 'In Progress',
                    'order_id' => $order->id
                ]);
            }

            if(!TrackOrder::whereOrderId($order->id)->whereTitle('Delivered')->exists()){
                TrackOrder::create([
                    'title' => 'Delivered',
                    'order_id' => $order->id
                ]);
            }
        }
    }


    public function setPromoCode($order)
    {

        $discount = json_decode($order->discount, true);
        if($discount != null){
            $code = PromoCode::find($discount['code']['id']);
            $code->no_of_times--;
            $code->update();
        }
    }


    public function steadfast($id)
    {
        $order = Order::findOrFail($id);
        $setting = \App\Models\Setting::first();

        if (!$setting->steadfast_api_key || !$setting->steadfast_secret_key) {
            return redirect()->back()->withErrors(__('Steadfast API credentials are missing.'));
        }

        $ship = json_decode($order->shipping_info, true);
        $bill = json_decode($order->billing_info, true);

        // Fallback to billing if shipping is not fully present
        $name = isset($ship['ship_first_name']) ? $ship['ship_first_name'] . ' ' . $ship['ship_last_name'] : $bill['bill_first_name'] . ' ' . $bill['bill_last_name'];
        $phone = isset($ship['ship_phone']) ? $ship['ship_phone'] : $bill['bill_phone'];
        $address = isset($ship['ship_address1']) ? $ship['ship_address1'] : $bill['bill_address1'];
        if (isset($ship['ship_city'])) {
            $address .= ', ' . $ship['ship_city'];
        }

        // \App\Helpers\PriceHelper::OrderTotal is not always available statically, let's calculate directly or use it if available
        $cod_amount = $order->payment_method == 'Cash On Delivery' ? \App\Helpers\PriceHelper::OrderTotal($order, true) : 0;

        $data = [
            'invoice' => $order->transaction_number,
            'recipient_name' => $name,
            'recipient_phone' => $phone,
            'recipient_address' => $address,
            'cod_amount' => $cod_amount,
            'note' => 'Order via Store'
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://portal.packzy.com/api/v1/create_order");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            "Api-Key: {$setting->steadfast_api_key}",
            "Secret-Key: {$setting->steadfast_secret_key}",
            "Content-Type: application/json"
        ]);

        $response = curl_exec($ch);
        $err = curl_error($ch);
        curl_close($ch);

        if ($err) {
            return redirect()->back()->withErrors(__('cURL Error: ') . $err);
        }

        $result = json_decode($response, true);

        if (is_array($result) && isset($result['status']) && $result['status'] == 200 && isset($result['consignment'])) {
            $order->update([
                'steadfast_consignment_id' => $result['consignment']['consignment_id'],
                'steadfast_tracking_code' => $result['consignment']['tracking_code'],
                'steadfast_status' => $result['consignment']['status']
            ]);
            return redirect()->back()->withSuccess(__('Order successfully sent to Steadfast Courier. Consignment ID: ' . $result['consignment']['consignment_id']));
        }

        $errorMessage = __('Failed to send order to Steadfast Courier.');
        if (is_array($result)) {
            if (isset($result['message'])) {
                $errorMessage = $result['message'];
            } elseif (isset($result['errors'])) {
                $errorMessage = json_encode($result['errors']);
            }
        } elseif (!empty(trim($response))) {
            $errorMessage = __('API Error: ') . strip_tags(trim($response));
        }
        
        return redirect()->back()->withErrors($errorMessage);
    }

    public function steadfastUpdateStatus($id)
    {
        $order = Order::findOrFail($id);
        $setting = \App\Models\Setting::first();

        if (!$order->steadfast_consignment_id) {
            return redirect()->back()->withErrors(__('Order is not sent to Steadfast Courier yet.'));
        }

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://portal.packzy.com/api/v1/status_by_cid/" . $order->steadfast_consignment_id);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            "Api-Key: {$setting->steadfast_api_key}",
            "Secret-Key: {$setting->steadfast_secret_key}",
            "Content-Type: application/json"
        ]);

        $response = curl_exec($ch);
        $err = curl_error($ch);
        curl_close($ch);

        if ($err) {
            return redirect()->back()->withErrors(__('cURL Error: ') . $err);
        }

        $result = json_decode($response, true);
        if (is_array($result) && isset($result['status']) && $result['status'] == 200 && isset($result['delivery_status'])) {
            $order->update([
                'steadfast_status' => $result['delivery_status']
            ]);
            return redirect()->back()->withSuccess(__('Steadfast Status Updated: ' . $result['delivery_status']));
        }

        $errorMessage = __('Failed to fetch Steadfast status.');
        if (is_array($result)) {
            if (isset($result['message'])) {
                $errorMessage = $result['message'];
            } elseif (isset($result['errors'])) {
                $errorMessage = json_encode($result['errors']);
            }
        } elseif (!empty(trim($response))) {
            $errorMessage = __('API Error: ') . strip_tags(trim($response));
        }
        return redirect()->back()->withErrors($errorMessage);
    }

    public function delete($id)
    {
        $order = Order::findOrFail($id);
        $order->tranaction->delete();
        if(Notification::where('order_id',$id)->exists()){
            Notification::where('order_id',$id)->delete();
        }
        if(count($order->tracks_data)>0){
            foreach($order->tracks_data as $track){
                $track->delete();
            }
        }
        $order->delete();
        return redirect()->back()->withSuccess(__('Order Deleted Successfully.'));
    }

}
