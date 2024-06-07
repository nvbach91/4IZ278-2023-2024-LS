<?php

require_once 'db/Messages.php';
require_once 'db/Meals.php';
require_once 'db/Orders.php';

$messagesDb = new MessagesDB();
$mealsDb = new MealsDB();
$ordersDb = new OrdersDB();

session_start();

// Check if the AJAX request is received
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if(!isset($_POST['content']) || trim($_POST['content']) == '' || !isset($_POST['meal_id'])){
        exit;
    }

    $user = $_SESSION['user'];
    $mealId = $_POST['meal_id'];

    $meal = $mealsDb->getMeal($mealId);
    $order = $ordersDb->getOrderByMeal($mealId);

    $content = htmlspecialchars($_POST['content']);
    
    $isSenderChef = $meal['chef_id'] == $user['id'];

    $senderId = $user['id'];
    $receiverId = $isSenderChef ? $order['buyer_id'] : $order['seller_id'];

    $result = $messagesDb->create([$mealId, $senderId, $receiverId, $content]);
    
    echo 1;
}
?>