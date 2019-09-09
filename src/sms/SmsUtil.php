<?php

namespace Fc\Utils\Sms;

use Dotenv\Dotenv;

class SmsUtil
{
    private static $apiKey = "";
    private static $sign = "";

    public function __construct(string $paths)
    {
        $d = Dotenv::create($paths, '.env');
        $d->load();

        self::$apiKey = getenv('SMS_LUOSIMAO_API_KEY');
        self::$sign = getenv('SMS_SIGN');
    }


    public function send($mobile, $message, $sign = null)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "http://sms-api.luosimao.com/v1/send.json");

        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_0);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 8);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);

        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($ch, CURLOPT_USERPWD, self::$apiKey);

        curl_setopt($ch, CURLOPT_POST, TRUE);

        if ($sign == null) {
            $sign = self::$sign;
        }
        $data = array(
            'mobile' => $mobile,
            'message' => $message . $sign
        );

        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

        $res = curl_exec($ch);
        curl_close($ch);

        return json_decode($res);
    }

}