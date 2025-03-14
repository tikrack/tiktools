<?php

use flight\database\PdoWrapper;

$db_host = env('DATABASE_HOST');
$db_name = env('DATABASE_NAME');
$db_user = env('DATABASE_USER');
$db_pass = env('DATABASE_PASSWORD');

Flight::register('db', PdoWrapper::class, [
    "mysql:host=$db_host;dbname=$db_name",
    $db_user,
    $db_pass,
    [
        PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'utf8mb4\'',
        PDO::ATTR_EMULATE_PREPARES => false,
        PDO::ATTR_STRINGIFY_FETCHES => false,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]
]);