<?php

use Dotenv\Dotenv;
include '../vendor/autoload.php';

$dotenv = Dotenv::createImmutable('../');
$dotenv->load();

?>