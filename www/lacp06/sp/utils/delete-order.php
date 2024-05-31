<?php

require_once '../db/database_class.php';

$ordersDB = new OrdersDB();
$bookOrdersDB = new BookOrdersDB();

if (isset($_GET['order_id'])) {
  $order_id = $_GET['order_id'];
  $bookOrders = $bookOrdersDB->findById($order_id);
  foreach ($bookOrders as $bookOrder) {
    $bookOrdersDB->delete($bookOrder['order_id']);
  }
  $ordersDB->delete($order_id);
}


header('Location: /www/lacp06/sp/routes/orders.php');
