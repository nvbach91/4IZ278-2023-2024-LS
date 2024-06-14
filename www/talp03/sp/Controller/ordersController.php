<?php

require '../Model/UserDB.php';
require '../Model/OrderDB.php';

$cancelMsg = '';

if (!isset($_COOKIE['email'])) {
    header('Location: ../View/index.php');
    exit('Unauthorized');
}

if (isset($_GET['msg'])) {
    $cancelMsg = $_GET['msg'];
}

$userDB = new UserDB();
$orderDB = new OrderDB();

$user = $userDB->findUserIDByEmail($_COOKIE['email'])[0];
$orders = $orderDB->findOrder($user['user_id']);

?>