<?php

namespace src\helpers;

class CurlHelper
{

    public static function requestGet(string $url)
    {
        $curl = curl_init();
        $headers = [
            'Content-Type: application/json; charset=utf-8',
        ];

        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

        $result = curl_exec($curl);

        curl_close($curl);

        return $result;
    }
}