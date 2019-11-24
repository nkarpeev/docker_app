<?php

namespace src\models;

use \RedBeanPHP\SimpleModel as RedBean_SimpleModel;
use GUMP;
use src\exceptions\ValidateException;

/**
 * Class Model_Orders
 * @package src\models
 */
class Model_Orders extends RedBean_SimpleModel
{

    /**
     * @throws ValidateException
     */
    public function update()
    {
        $gump = new GUMP('ru');
        $gump->validation_rules([
            'from'          => 'required|max_len,100|min_len,5',
            'destination'   => 'required|max_len,100|min_len,5',
            'delivery_date' => 'required',
            'name'          => 'required|max_len,30|min_len,2',
            'phone'         => 'required',
        ]);

        $gump->filter_rules([
            'from'          => 'trim|sanitize_string',
            'destination'   => 'trim|sanitize_string',
            'delivery_date' => 'trim|sanitize_string',
            'name'          => 'trim|sanitize_string',
            'phone'         => 'trim|sanitize_string',
        ]);

        GUMP::set_field_name("from", "Откуда доставить");
        GUMP::set_field_name("destination", "Куда доставить");
        GUMP::set_field_name("delivery_date", "Дата доставки");
        GUMP::set_field_name("name", "Ваше имя");
        GUMP::set_field_name("phone", "Ваш телефон");


        $gump->sanitize($this->bean->getProperties());
        $validated_data = $gump->run($this->bean->getProperties());

        if ($validated_data === false) {
            throw new ValidateException(serialize($gump->get_errors_array()));
        }
    }
}