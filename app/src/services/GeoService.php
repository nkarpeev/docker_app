<?php

namespace src\services;

use src\helpers\CurlHelper;

class GeoService
{
    /**
     * @param string $address
     * @return null|string
     * @throws \ErrorException
     */
    public static function getCoordsByAddress(string $address) :?string
    {
        try{
            $geoApiKey = 'a97a178a-fc13-4766-9eaf-27d82ba3ed89';
            $address = urlencode(trim($address));
            $url = "https://geocode-maps.yandex.ru/1.x/?apikey={$geoApiKey}&format=json&language=ru_RU&results=1&geocode={$address}";

            $result = json_decode(CurlHelper::requestGet($url), true);
            $coords = $result['response']['GeoObjectCollection']['featureMember'][0]['GeoObject']['Point']['pos'];
            return $coords;
        }
        catch (\ErrorException $e) {
            throw new \ErrorException('Coordinates not find');
        }

    }

}