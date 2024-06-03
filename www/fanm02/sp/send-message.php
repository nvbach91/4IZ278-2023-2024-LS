<?php

require_once 'db/Messages.php';

$messagesDb = new MessagesDB();

// Check if the AJAX request is received
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if(!isset($_POST['content']) || !isset($_POST['meal_id']) || !isset($_POST['sender_id']) || !isset($_POST['receiver_id'])){
        exit;
    }

    $content = $_POST['content'];
    $meal_id = $_POST['meal_id'];
    $sender_id = $_POST['sender_id'];
    $receiver_id = $_POST['receiver_id'];

    $result = $messagesDb->create([$meal_id, $sender_id, $receiver_id, $content]);
    
    echo 1;
}
?>