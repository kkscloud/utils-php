<?php

namespace Fc\Utils\Small;

class Small
{
    public static function getUUID($case = null)
    {
        if ($case == 'upper') {
            return strtoupper(md5(uniqid(md5(microtime(true)), true)));
        }
        return strtoupper(md5(uniqid(md5(microtime(true)), true)));
    }

    public static function getRandomNum($length = 6)
    {
        return rand(pow(10, ($length - 1)), pow(10, $length) - 1);
    }


    public static function getRandomStr($num = 32, $case = null)
    {
        if ($case == 'upper') {
            return substr(strtoupper(md5(uniqid(md5(microtime(true)), true))), 0, $num);
        }
        return substr(strtolower(md5(uniqid(md5(microtime(true)), true))), 0, $num);
    }

    public static function getMsTime()
    {
        list($microseconds, $sec) = explode(' ', microtime());
        $ms = (float)sprintf('%.0f', (floatval($microseconds) + floatval($sec)) * 1000);
        return $ms;
    }

    public static function getRealIp()
    {
        if (getenv("HTTP_CLIENT_IP") && strcasecmp(getenv("HTTP_CLIENT_IP"), "unknown")) {
            $ip = getenv("HTTP_CLIENT_IP");
        } else if (getenv("HTTP_X_FORWARDED_FOR") && strcasecmp(getenv("HTTP_X_FORWARDED_FOR"), "unknown")) {
            $ip = getenv("HTTP_X_FORWARDED_FOR");
        } else if (getenv("REMOTE_ADDR") && strcasecmp(getenv("REMOTE_ADDR"), "unknown")) {
            $ip = getenv("REMOTE_ADDR");
        } else if (isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], "unknown")) {
            $ip = $_SERVER['REMOTE_ADDR'];
        } else {
            $ip = "unknown";
        }
        return $ip;
    }

}