<?php

// automaticke nacteni trid
require __DIR__ . '/../vendor/autoload.php';

// nacteni namespace trid
use Monolog\Level;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;


$log = new Logger('test');
$log->pushHandler(new StreamHandler('./test.log', Level::Warning));

// add log
$log->warning('This is a test log');

?>