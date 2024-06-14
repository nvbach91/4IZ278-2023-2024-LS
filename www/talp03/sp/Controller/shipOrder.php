<?php

require '../Model/OrderDB.php';
$orderDB = new OrderDB();

if ($_GET['order_id']) {
    $orderDB->updateOrderState($_GET['order_id'], 'shiped');
}

header('Location: ../View/user-orders.php');
exit();

?>