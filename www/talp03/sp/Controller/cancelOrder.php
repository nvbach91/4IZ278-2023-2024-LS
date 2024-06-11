<?php

require '../Model/OrderDB.php';

$orderDB = new OrderDB();

if (isset($_GET['order_id'])) {
    $orderId = htmlspecialchars($_GET['order_id']);
    $orderDB->deleteOrder($orderId, 'paid');
    
    $subject = 'Cancelation of your order';
    $message = 'We canceled your order.';
    $headers = 'From: furniture@example.com' . "\r\n" .
    'Reply-To: furniture@example.com' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

    $success = mail('talp03@vse.cz', $subject, $message, $headers);
    if (!$success) {
        $errorMessage = error_get_last()['message'];
        var_dump($errorMessage);
    }
}

header('Location: ../View/orders.php');
exit();

?>