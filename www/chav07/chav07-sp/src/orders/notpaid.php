<?php
use Vilem\BookBookGo\database\OrderRepository;

require_once __DIR__ . "/../../vendor/autoload.php";
require_once __DIR__ . "/../authentication/AuthUtils.php";
require_once __DIR__ . "/../database/OrderRepository.php";
require_once __DIR__ . "/../config.php";
require_once __DIR__ . "/ordersCommons.php";


$id = ordersCommon();
$repository = new OrderRepository();
$order = $repository->getOrder($id);
$order->paid = false;
$repository->updateOrder($order);
header("HTTP/1.1 200 OK");
header("Location: " . htmlspecialchars(BASE_URL . "/orders.php"));
exit(200);



?>
