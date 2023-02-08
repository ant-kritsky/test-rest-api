<?php

$dbConf = [
    'HOST' => 'localhost',
    'PORT' => '3306',
    'DATABASE' => 'test-rest-api',
    'USERNAME' => 'root',
    'PASSWORD' => '',
];

require_once __DIR__ . '/app/bootstrap.php';

\app\DatabaseConnector::init($dbConf);