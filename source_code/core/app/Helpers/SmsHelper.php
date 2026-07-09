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