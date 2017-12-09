<?php

$dotenv = new DotEnv\DotEnv(__DIR__);
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
        ]
    ]
];