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
        $body = preg_replace("/{order_number}/", $order_number ,$sms_section[$type]);
        
        $order = \App\Models\Order::where('transaction_number', $order_number)->first();
        if($order) {
            $order_amount = \App\Helpers\PriceHelper::setCurrencyPrice($order->pay_amount);
            $order_date = $order->created_at->format('d M Y');
            $body = preg_replace("/{order_amount}/", $order_amount, $body);
            $body = preg_replace("/{order_date}/", $order_date, $body);
        }

        try {
            $url = $setting->sms_url;
            $url = str_replace('{number}', $to_number, $url);
            $url = str_replace('{message}', urlencode($body), $url);

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
            $response = curl_exec($ch);
            curl_close($ch);
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

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
            $response = curl_exec($ch);
            curl_close($ch);
        } catch (\Throwable $th) {
            // throw $th;
        }
    }
}