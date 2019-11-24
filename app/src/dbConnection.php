<?php

use \RedBeanPHP\R as R;

//print_r(phpinfo());
//die;

R::setup('mysql:host=db;dbname=testcase_dostavka_lab',
    'user_dostavka_lab', '123456');

if (!R::testConnection()) {
    exit ('Нет соединения с базой данных');
}

R::useFeatureSet('novice/latest');

R::ext('xdispense', function ($table_name) {
    return R::getRedBean()->dispense($table_name);
});
R::freeze(true);