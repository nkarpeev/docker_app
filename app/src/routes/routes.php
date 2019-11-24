<?php

use src\controllers\OrderController;

$app->any('/', OrderController::class . ':create')
    ->setName('order');