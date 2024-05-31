<?php
require_once __DIR__ . '/db/OrderDatabase.php';
require_once __DIR__ . '/db/UserDatabase.php';

$productsDB = new OrdersDatabase();


$currentUrlParams = $_SERVER['QUERY_STRING'];

$urlParamsArr = explode("&", $currentUrlParams);

$orderId = 0;
for ($i = 0; $i < count($urlParamsArr); $i++) {
    if (str_contains($urlParamsArr[$i], 'orderId')) {
        $orderId = explode('=', $urlParamsArr[$i])[1];
    }
}

$order = $productsDB->readOrderById($orderId)[0];
var_dump($order);

$usersDB = new UsersDatabase();

$result = $usersDB->readUserById($order['idUser'])[0];

var_dump($result['email']);
var_dump($order['idOrder']);

$newState = 'paid';

$productsDB->updateOrder($order['idOrder'], $newState);


// Define the recipient, subject, and body of the email
// $recipient = $result['email'];
$recipient = 'jana19@vse.cz';
$subject = 'Order Payment Confirmation';
$message = 'Hello, your order has been paid successfully.';

// Set up additional headers
$headers = 'From: jana19@vse.cz' . "\r\n" .
    'Reply-To: jana19@vse.cz' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

// Use the mail() function to send the email
if (mail($recipient, $subject, $message, $headers)) {
    echo "Email successfully sent!";
} else {
    echo "Failed to send email.";
}

header('Location: orderConfirmation.php?orderId=' . $order['idOrder']);
exit();
