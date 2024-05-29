<?php
require __DIR__ . '/includes/header.php';

?>

<?php
session_start();
require_once __DIR__ . '/db/OrderDatabase.php';
require_once __DIR__ . '/db/UserDatabase.php';

if (!isset($_SESSION['user_id'])) {
    // If user is not logged in, redirect to login page
    header('Location: login.php');
    exit();
}

if (!empty($_SESSION['cart'])) {
    $userId = $_SESSION['user_id'];
    $currentDate = date('Y-m-d H:i:s');
    $orderState = 'pending'; // Initial state of the order

    // Insert the order into the Orders table
    $ordersDB = new OrdersDatabase();
    $orderId = $ordersDB->createOrder($userId, $currentDate, $orderState);

    if ($orderId) {
        // Insert each product into the OrderProducts table

        $totalCost = 0;

        foreach ($_SESSION['cart'] as $item) {

            $itemCost = $item['quantity'] * ($item['price'] * (1 - $item['discount'] * 0.01));

            $totalCost += $itemCost;

            $ordersDB->createOrderProduct(
                $orderId,
                $item['idProduct'],
                $item['quantity'],
                $item['price'],
                $item['discount']
            );
        }

        session_start();
        $_SESSION['totalCost'] = $totalCost;

        // Clear the cart after successful order placement
        unset($_SESSION['cart']);

        $usersDB = new UsersDatabase();

        $result = $usersDB->readUserById($_SESSION['user_id'])[0];

        // Define the recipient, subject, and body of the email
        // $recipient = $result['email'];
        $recipient = 'jana19@vse.cz';
        $subject = 'Order Confirmation';
        $message = 'Hello, your order has been placed and is waiting for payment.';

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

        header('Location: orderConfirmation.php?orderId=' . $orderId);
        exit();
    } else {
        // Handle error
        echo "Error placing order. Please try again.";
    }
} else {
    // If cart is empty, redirect to cart page
    header('Location: cart.php');
    exit();
}
?>


<?php require __DIR__ . '/includes/footer.php'; ?>