<?php
namespace App\Helpers;
use App\Models\Setting;
use Twilio\Rest\Client;

class SmsHelper {

    public function SendSms($to_number ,$type,$order_number = null)
    {
        $setting = Setting::first();
        if ($setting->is_twilio == 0 || empty($setting->sms_url)) {
            return;
        }

        $sms_section = json_decode($setting->twilio_section,true);
        $template = $sms_section[$type] ?? '';
        $body = preg_replace("/{order_number}/", $order_number , $template);
        
        $order = \App\Models\Order::where('transaction_number', $order_number)->first();
        if($order) {
            $total = \App\Helpers\PriceHelper::OrderTotal($order);
            $order_amount = ($setting->currency_direction == 1) ? $order->currency_sign . $total : $total . $order->currency_sign;
            
            $order_date = $order->created_at->format('d M Y');
            
            $billing = json_decode($order->billing_info, true);
            $customer_name = ($billing['bill_first_name'] ?? '') . ' ' . ($billing['bill_last_name'] ?? '');
            $customer_phone = $billing['bill_phone'] ?? '';
            
            $addressFields = [];
            if(!empty($billing['bill_address1'])) $addressFields[] = $billing['bill_address1'];
            if(!empty($billing['bill_address2'])) $addressFields[] = $billing['bill_address2'];
            if(!empty($billing['bill_city'])) $addressFields[] = $billing['bill_city'];
            $customer_address = implode(', ', $addressFields);
            
            $cart = json_decode($order->cart, true);
            $items = [];
            if($cart) {
                foreach ($cart as $item) {
                    $items[] = ($item['name'] ?? 'Item') . ' x ' . ($item['qty'] ?? 1);
                }
            }
            $order_items = implode(', ', $items);

            $body = preg_replace("/{order_amount}/", $order_amount, $body);
            $body = preg_replace("/{order_date}/", $order_date, $body);
            $body = preg_replace("/{customer_name}/", $customer_name, $body);
            $body = preg_replace("/{customer_phone}/", $customer_phone, $body);
            $body = preg_replace("/{customer_address}/", $customer_address, $body);
            $body = preg_replace("/{order_items}/", $order_items, $body);
        }

        try {
            $url = $setting->sms_url;
            $url = str_replace('{number}', $to_number, $url);
            $url = str_replace('{message}', urlencode($body), $url);

            if (function_exists('exec') && !in_array('exec', array_map('trim', explode(', ', ini_get('disable_functions'))))) {
                exec("curl -s -o /dev/null -w '' " . escapeshellarg($url) . " > /dev/null 2>&1 &");
            } else {
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
                curl_setopt($ch, CURLOPT_TIMEOUT, 2);
                $response = curl_exec($ch);
                curl_close($ch);
            }
        } catch (\Throwable $th) {
            // throw $th;
        }
    }

    public function SendCustomSms($to_number, $body)
    {
        $setting = Setting::first();
        if ($setting->is_twilio == 0 || empty($setting->sms_url) || empty($to_number)) {
            return;
        }

        try {
            $url = $setting->sms_url;
            $url = str_replace('{number}', $to_number, $url);
            $url = str_replace('{message}', urlencode($body), $url);

            if (function_exists('exec') && !in_array('exec', array_map('trim', explode(', ', ini_get('disable_functions'))))) {
                exec("curl -s -o /dev/null -w '' " . escapeshellarg($url) . " > /dev/null 2>&1 &");
            } else {
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
                curl_setopt($ch, CURLOPT_TIMEOUT, 2);
                $response = curl_exec($ch);
                curl_close($ch);
            }
        } catch (\Throwable $th) {
            // throw $th;
        }
    }
}