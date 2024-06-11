<?php

require '../Model/OrderDB.php';

$orderDB = new OrderDB();

if (isset($_GET['order_id'])) {
    $orderId = htmlspecialchars($_GET['order_id']);
    $orderDB->updateOrderState($orderId, 'paid');
    
    $subject = 'Confirmation of payment for your order';
    $message = 'We have recieved your payment for order.' . "\n" .
                'Order is now being prepared to be shiped to your location.';
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