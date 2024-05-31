<?php

require_once '../db/database_class.php';
require_once '../utils/admin-check.php';

$ordersDB = new OrdersDB();
$bookOrdersDB = new BookOrdersDB();

if (isset($_GET['order_id'])) {
  $order_id = $_GET['order_id'];
  $ordersDB->updateState($order_id, 'Odesláno');
}


header('Location: /www/lacp06/sp/routes/orders.php');
