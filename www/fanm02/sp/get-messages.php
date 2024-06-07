<?php

require_once 'db/Messages.php';

$messagesDb = new MessagesDB();

session_start();

// Check if the AJAX request is received
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if(!isset($_POST['meal_id'])){
        exit;
    }

    $mealId = $_POST['meal_id'];
    $offset = $_POST['offset'] ?? 0;
    $registeredUser = $_SESSION['user'];

    $result = $messagesDb->getMessages($mealId, $registeredUser['id'], $offset);

    echo json_encode($result);
}
?>