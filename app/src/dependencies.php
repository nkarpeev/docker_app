<?php

$container = $app->getContainer();

$container['view'] = function ($c) {
    $view = new \Slim\Views\Twig(ROOT . '/src/views', [
        'debug' => true, // This line should enable debug mode
        'cache' => false,
    ]);

    // Instantiate and add Slim specific extension
    $basePath = rtrim(str_ireplace('index.php', '', $c['request']->getUri()->getBasePath()), '/');
    $view->addExtension(new Slim\Views\TwigExtension($c['router'], $basePath));

    return $view;
};

$container['additional_services_for_orders'] = function ($c) {
    return new \src\models\Model_Additional_services_for_orders();
};