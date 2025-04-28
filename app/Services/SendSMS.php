<?php


namespace App\Services;

use reactsms_sdk_php\SDK\Reactsms;



class SendSMS {

    static function send($dialcode, $phone, $message) {
        $AUTH_KEY = "rs_22482e7e3ddf0173e356c8d4efa4ac6d";
        $API_KEY = "rs_da72955b627c7f3118ef02384afa8c0d";
        $SERVICE_KEY = "609523";

        $reactsms = new Reactsms($AUTH_KEY, $API_KEY, $SERVICE_KEY);

        $response = $reactsms->send_message($message, [["zip_code" => "+".$dialcode, "number" => $phone]]);
        return $response;
    }


}
