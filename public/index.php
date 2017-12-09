<?php

require '../vendor/autoload.php';
$settings = require '../src/config/config.php';

$app = new \Slim\App($settings);

require '../src/helpers/dependencies.php';
require '../src/helpers/middlewares.php';
require '../src/routes/routes.php';

$app->run();