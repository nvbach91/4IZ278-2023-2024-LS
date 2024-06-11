<?php

use Dotenv\Dotenv;
include '../vendor/autoload.php';

$dotenv = Dotenv::createImmutable('../');
$dotenv->load();

var_dump($_ENV['CLIENT_ID']);
var_dump($_ENV['CLIENT_SECRET']);

?>