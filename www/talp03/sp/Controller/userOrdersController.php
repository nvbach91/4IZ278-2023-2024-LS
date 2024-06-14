<?php

require '../Model/OrderDB.php';

$orderDB = new OrderDB();

$orders = $orderDB->findAll();

?>