<?php require __DIR__ . '/../includes/header.php'; ?>
<?php
require_once __DIR__ . '/../db/UserDatabase.php';
require_once __DIR__ . '/../db/OrderDatabase.php';

session_start();
$totalCost = $_SESSION['totalCost'];

$ordersDB = new OrdersDatabase();
$orders = $ordersDB->readAllOrders();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['cancelOrder'])) {
        $newState = 'canceled';
        $orderId = $_POST['orderId'];
        $result = $ordersDB->updateOrder($orderId, $newState);

        if ($result) {
            echo "Order canceled successfully!";

            // Define the recipient, subject, and body of the email
            // $recipient = $result['email'];
            $recipient = 'jana19@vse.cz';
            $subject = 'Order Sent';
            $message = 'Hello, your order was sent successfully.';

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

            header("Location: " . $_SERVER['REQUEST_URI']);
            exit();
        } else {
            echo "Error: Could not cancel order.";
        }
    }

    if (isset($_POST['sendOrder'])) {
        $newState = 'sent';
        $orderId = $_POST['orderId'];
        $result = $ordersDB->updateOrder($orderId, $newState);

        if ($result) {
            echo "Order canceled successfully!";

            // Define the recipient, subject, and body of the email
            // $recipient = $result['email'];
            $recipient = 'jana19@vse.cz';
            $subject = 'Order Canceled';
            $message = 'Hello, your order has been canceled.';

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

            header("Location: " . $_SERVER['REQUEST_URI']);
            exit();
        } else {
            echo "Error: Could not send order.";
        }
    }
}

?>

<main class="container">
    <h1 class="my-4">Orders administration</h1>
    <div>
        <?php foreach ($orders as $order) : ?>
            <div class="list-group-item">
                <form method="POST" action="">
                    <?php

                    $usersDB = new UsersDatabase();

                    $result = $usersDB->readUserById($order['idUser'])[0];

                    $listProducts = $ordersDB->readOrderItems($order['idOrder']);


                    ?>

                    <span>User ID: <?= number_format($order['idUser'], 0); ?> <?= htmlspecialchars($result['email']); ?></span>
                    <br>
                    <span>Order ID: <?= number_format($order['idOrder'], 0); ?></span>
                    <span>Placed on: <?= htmlspecialchars($order['date'], ENT_QUOTES, 'UTF-8'); ?></span>
                    <span>State: <?= htmlspecialchars($order['state'], ENT_QUOTES, 'UTF-8'); ?></span>
                    <br><br>
                    <?php foreach ($listProducts as $listproduct) : ?>
                        <div class="list-group-item">

                            <span>Product name: <?= htmlspecialchars($listproduct['name'], ENT_QUOTES, 'UTF-8'); ?> – </span>
                            <span><?= number_format($listproduct['productQuantity'], 0); ?>x</span>

                        </div>
                    <?php endforeach; ?>
                    <br><br>
                    <span>Total cost: <?= number_format($totalCost, 0); ?> CZK</span>
                    <hr>
                    <div>
                        <?php if ($order['state'] == 'paid') : ?>
                            <button class="btn btn-info " type="submit" name="sendOrder">Send order</button>
                            <input type="hidden" name="orderId" value="<?= $user['idorder']; ?>">
                        <?php endif; ?>
                        <?php if ($order['state'] == 'sent' || $order['state'] == 'canceled') : ?>
                        <?php else : ?>
                            <button class="btn btn-danger float-right" type="submit" name="cancelOrder">Cancel order</button>
                            <input type="hidden" name="orderId" value="<?= $order['idOrder']; ?>">
                            <br><br>
                        <?php endif; ?>

                    </div>

                </form>
            </div>
        <?php endforeach; ?>
    </div>
    <br>
</main>
<?php require __DIR__ . '/../includes/footer.php'; ?>