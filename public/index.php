<?php

require '../vendor/autoload.php';
$settings = require '../src/config.php';

$app = new \Slim\App($settings);

require '../src/dependencies.php';
require '../src/middlewares.php';
require '../src/routes.php';

$app->run();