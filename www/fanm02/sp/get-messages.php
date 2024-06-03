<?php

require_once 'db/Messages.php';

$messagesDb = new MessagesDB();

// Check if the AJAX request is received
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if(!isset($_POST['meal_id'])){
        exit;
    }

    $mealId = $_POST['meal_id'];

    $result = $messagesDb->getMessages($mealId);

    echo json_encode($result);
}
?>