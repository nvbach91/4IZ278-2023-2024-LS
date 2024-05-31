<?php
require_once __DIR__ . '/../db/OrderDatabase.php';
require_once __DIR__ . '/../db/UserDatabase.php';

$ordersDB = new OrdersDatabase();


$currentUrlParams = $_SERVER['QUERY_STRING'];

$urlParamsArr = explode("&", $currentUrlParams);

$orderId = 0;
for ($i = 0; $i < count($urlParamsArr); $i++) {
    if (str_contains($urlParamsArr[$i], 'orderId')) {
        $orderId = explode('=', $urlParamsArr[$i])[1];
    }
}

$orders = $ordersDB->readOrderById($orderId);
$listProducts = $ordersDB->readOrderItems($orderId);

session_start();
$totalCost = $_SESSION['totalCost'];

?>

<div>
    <?php foreach ($orders as $order) : ?>
        <div class="list-group-item">
            <form method="POST" action="">
                <?php

                $usersDB = new UsersDatabase();

                $result = $usersDB->readUserById($order['idUser'])[0];


                ?>

                <span>User ID: <?= number_format($order['idUser'], 0); ?> <?= htmlspecialchars($result['email']); ?></span>
                <br>
                <span>Order ID: <?= number_format($order['idOrder'], 0); ?></span>
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
                <?php if ($order['state'] == 'pending') : ?>

                    <a id="payForOrderLink" class="btn btn-danger" href="./pay.php?orderId=<?php echo $order['idOrder']; ?>"> Pay </a>

                <?php else : ?>
                    Your order has been paid!
                    We will send you an email when the order is sent.
                <?php endif; ?>

            </form>
        </div>
    <?php endforeach; ?>
</div>