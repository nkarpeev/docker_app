<?php

namespace src\models;

use \RedBeanPHP\SimpleModel as RedBean_SimpleModel;
use \RedBeanPHP\R as R;

class Model_Additional_services_for_orders extends RedBean_SimpleModel
{
    /**
     * @param array|null $addServices
     * @param int $orderID
     */
    public function saveServicesForOrders(?array $addServices, int $orderID): void
    {
        $addServicesForOrders = [];
        foreach ($addServices as $serviceID) {
            if(is_numeric($serviceID)) {
                $bean = R::xdispense('additional_services_for_orders');
                $bean->order_id = $orderID;
                $bean->additional_service_id = $serviceID;
                $addServicesForOrders[] = $bean;
            }
        }

        R::storeAll($addServicesForOrders);
    }
}