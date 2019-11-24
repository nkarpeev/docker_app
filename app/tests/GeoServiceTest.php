<?php

namespace tests;

use PHPUnit\Framework\TestCase;
use src\services\GeoService;

class GeoServiceTest extends TestCase
{
    private $mGeoService;

    public function __construct($name = null, array $data = [], $dataName = '')
    {
//        $this->mGeoService = $this->getMockBuilder(GeoService::class)->getMock();
        parent::__construct($name, $data, $dataName);
    }

    public function testGetCoordsByAddress() {
        $this->assertEquals('37.734479 55.684067', GeoService::getCoordsByAddress('Москва, Курская 11'));
    }


}