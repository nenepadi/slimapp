<?php

$dotenv = new Dotenv\Dotenv(__DIR__);
$dotenv->load();

return [
    "settings" => [
        "displayErrorDetails" => true,
        "addContentLengthHeader" => false,
        "db" => [
            "type" => $_ENV['DB_TYPE'],
            "host" => $_ENV['DB_HOST'],
            "name" => $_ENV['DB_NAME'],
            "user" => $_ENV['DB_USER'],
            "passwd" => $_ENV['DB_PASS']
        ],
        "logger" => [
            "name" => "slimapp",
            "path" => "../logs/app.log",
            'level' => \Monolog\Logger::DEBUG
        ]
    ]
];