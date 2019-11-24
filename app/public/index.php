<?php

require '../vendor/autoload.php';

defined('ROOT') or define('ROOT', dirname(__DIR__));
defined('DEBUG') or define('DEBUG', true);
define('REDBEAN_MODEL_PREFIX', '\src\models\Model_');

$config = [
    'settings' => [
        'displayErrorDetails' => (DEBUG),
    ],
];

$c = new \Slim\Container($config);
$app = new \Slim\App($c);

require_once ROOT . '/src/dependencies.php';
require_once ROOT . '/src/dbConnection.php';
require_once '../src/routes/routes.php';

$app->run();