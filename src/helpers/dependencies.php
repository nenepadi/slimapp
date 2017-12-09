<?php

$container = $app->getContainer();
$container['db'] = function($c){
    $dbConfig = $c['settings']['db'];
    return new \Database($dbConfig);
};