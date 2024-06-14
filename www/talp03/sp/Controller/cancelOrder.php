<?php

require '../Model/OrderDB.php';

$orderDB = new OrderDB();
$successMsg;

if (isset($_GET['order_id'])) {
    $orderId = htmlspecialchars($_GET['order_id']);
    $orderDB->deleteOrder($orderId, 'paid');

    $successMsg = "We canceled order number $orderId";
    
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

header("Location: ../View/orders.php?msg=$successMsg");
exit();

?>