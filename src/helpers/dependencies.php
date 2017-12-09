<?php

$container = $app->getContainer();

// Database connection ...
$container['db'] = function($c){
    $dbConfig = $c['settings']['db'];
    return new \Database($dbConfig);
};

// Logger ...
$container['logger'] = function ($c) {
    $settings = $c['settings']['logger'];
    $logger = new Monolog\Logger($settings['name']);
    $logger->pushProcessor(new Monolog\Processor\UidProcessor());
    $logger->pushHandler(new Monolog\Handler\StreamHandler($settings['path'], $settings['level']));
    return $logger;
};