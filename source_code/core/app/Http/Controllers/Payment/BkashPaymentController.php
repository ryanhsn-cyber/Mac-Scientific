<?php

namespace App\Http\Controllers\Payment;

use App\Helpers\EmailHelper;
use App\Helpers\PriceHelper;
use App\Helpers\SmsHelper;
use App\Http\Controllers\Controller;
use App\Models\Currency;
use App\Models\Item;
use App\Models\Notification;
use App\Models\Order;
use App\Models\PromoCode;
use App\Models\Setting;
use App\Models\ShippingService;
use App\Models\State;
use App\Models\TrackOrder;
use App\Services\Payment\BkashTokenizedService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class BkashPaymentController extends Controller
{
    protected $bkashService;

    public function __construct(BkashTokenizedService $bkashService)
    {
        $this->bkashService = $bkashService;
    }

    /**
     * Start the payment process
     */
    public function process(Request $request)
    {
        $request->validate([
            'state_id' => State::count() > 0 ? 'required' : '',
        ]);
        
        if(Session::has('currency')){
            $currency = Currency::findOrFail(Session::get('currency'));
        }else{
            $currency = Currency::where('is_default', 1)->first();
        }

        $supported = ['BDT'];
        if(!in_array($currency->name, $supported)){
            Session::flash('error', __('Currency Not Supported (Only BDT)'));
            return redirect()->back();
        }

        $user = Auth::user();
        $cart = Session::get('cart');

        $total_tax = 0;
        $cart_total = 0;
        $total = 0;
        $option_price = 0;
        foreach($cart as $key => $item){
            $total += $item['main_price'] * $item['qty'];
            $option_price += $item['attribute_price'];
            $cart_total = $total + $option_price;
            $item_model = Item::findOrFail($key);
            if($item_model->tax){
                $total_tax += $item_model::taxCalculate($item_model);
            }
        }
        
        $shipping = [];
        if(ShippingService::whereStatus(1)->whereId(1)->whereIsCondition(1)->exists()){
            $shipping = ShippingService::whereStatus(1)->whereId(1)->whereIsCondition(1)->first();
            if($cart_total >= $shipping->minimum_price){
                $shipping = $shipping;
            }else{
                $shipping = [];
            }
        }

        if(!$shipping){
            $shipping = ShippingService::whereStatus(1)->where('id', '!=', 1)->first(); 
        }
        
        $discount = Session::has('coupon') ? Session::get('coupon') : [];
        if (!PriceHelper::Digital()) $shipping = null;

        $txnid = "BKASH_TXN_" . uniqid();
        
        $grand_total = ($cart_total + ($shipping ? $shipping->price : 0)) + $total_tax;
        $grand_total = $grand_total - ($discount ? $discount['discount'] : 0);
        $grand_total += PriceHelper::StatePrce($request->state_id, $cart_total);
        $total_amount = PriceHelper::setConvertPrice($grand_total);
        
        $orderData = [
            'state' => $request['state_id'] ? json_encode(State::findOrFail($request['state_id']), true) : null,
            'cart' => json_encode($cart, true),
            'discount' => json_encode($discount, true),
            'shipping' => json_encode($shipping, true),
            'tax' => $total_tax,
            'state_price' => PriceHelper::StatePrce($request['state_id'], $cart_total),
            'shipping_info' => json_encode(Session::get('shipping_address'), true),
            'billing_info' => json_encode(Session::get('billing_address'), true),
            'payment_method' => 'bKash API',
            'order_status' => 'Pending',
            'user_id' => isset($user) ? $user->id : 0,
            'transaction_number' => Str::random(10),
            'currency_sign' => PriceHelper::setCurrencySign(),
            'currency_value' => PriceHelper::setCurrencyValue(),
            'txnid' => $txnid,
            'amount' => $total_amount
        ];
         
        // Initialize payment via Service
        try {
            $paymentResponse = $this->bkashService->initializePayment($orderData);
            
            if ($paymentResponse['status'] === true) {
                // Save Order only if initialization successful
                Order::create($orderData);
                return redirect()->away($paymentResponse['link']);
            }
            
            return redirect()->back()->with('unsuccess', $paymentResponse['message']);
            
        } catch (\Exception $e) {
            return redirect()->back()->with('unsuccess', $e->getMessage());
        }
    }

    /**
     * Callback after bKash redirects back
     */
    public function callback(Request $request)
    {
        $callbackData = $request->all();
        
        try {
            $response = $this->bkashService->executePayment($callbackData);
            
            if ($response['status'] === true) {
                $order = Order::where('transaction_number', $response['transaction_number'])->first();
                
                if ($order && $order->payment_status !== 'Paid') {
                    $order->update([
                        'payment_status' => 'Paid',
                        'txnid' => $response['trxID'] // Real bKash TRX ID
                    ]);
                    
                    TrackOrder::create([
                        'title' => 'Pending',
                        'order_id' => $order->id,
                    ]);
                    
                    $this->finalizeOrderOperations($order);
                    
                    return redirect()->route('front.checkout.success');
                }
            }
            
            Session::put('message', $response['message'] ?? 'Payment Failed or Cancelled');
            return redirect()->route('front.checkout.cancle');
            
        } catch (\Exception $e) {
            Session::put('message', $e->getMessage());
            return redirect()->route('front.checkout.cancle');
        }
    }

    /**
     * Server-to-Server Webhook
     */
    public function webhook(Request $request)
    {
        // Parse webhook payload
        $payload = $request->all();
        
        // Let service handle webhook logic
        $isValid = $this->bkashService->handleWebhook($payload);
        
        if ($isValid) {
            // Further logic if bKash sends TRX status directly to webhook
        }
        
        return response()->json(['status' => 'success']);
    }

    /**
     * Finalize Order (Emails, SMS, Cart cleanup)
     */
    private function finalizeOrderOperations($order)
    {
        $user = Auth::user();
        $cart = Session::get('cart');
        
        PriceHelper::Transaction($order->id, $order->transaction_number, EmailHelper::getEmail(), PriceHelper::OrderTotal($order, 'trns'));
        PriceHelper::LicenseQtyDecrese($cart);

        Notification::create(['order_id' => $order->id]);

        $emailData = [
            'to' => EmailHelper::getEmail(),
            'type' => "Order",
            'user_name' => isset($user) ? $user->displayName() : Session::get('billing_address')['bill_first_name'],
            'order_cost' => PriceHelper::OrderTotal($order),
            'transaction_number' => $order->transaction_number,
            'site_title' => Setting::first()->title,
        ];

        $email = new EmailHelper();
        $email->sendTemplateMail($emailData);

        Session::put('order_id', $order->id);
        Session::forget('cart');
        Session::forget('discount');
        Session::forget('coupon');
        
        $setting = Setting::first();
        if($setting->is_twilio == 1){
            $sms = new SmsHelper();
            $user_number = json_decode($order->billing_info, true)['bill_phone'] ?? null;
            if($user_number){
                $sms->SendSms($user_number, "'purchase'", $order->transaction_number);
            }
        }
    }
}
