<?php
require '../Controller/ordersController.php';
?>

<?php include './includes/head.php'; ?>
<body>
    <?php require './includes/navbar.php'; ?>
    <main>
        <div class="container-cart">
            <div class="products">
                <?php foreach ($orders as $order): ?>
                    <div class="order">
                        <div class="order-body">
                            <div class="order-bodystart">
                                <h5 class="order-id"><?php echo 'Order number: ' . $order['order_id']; ?></h5>
                                <p class="order-date"><?php echo $order['date']; ?></p>
                                <?php if ($order['state'] == 'pending') { ?>
                                    <a href="../Controller/cancelOrder.php?order_id=<?php echo $order['order_id']; ?>" class="cancel edit-button">Cancel order</a>
                                <?php } ?>
                            </div>
                            <div class="order-bodyend">
                                <p class="order-price"><?php echo 'Total price: ' . $order['total_price'] . ' Kč'; ?></p>
                                <p class="order-state"><?php echo 'Payment status: ' . $order['state']; ?></p>
                                <?php if ($order['state'] == 'pending') { ?>
                                    <a href="../Controller/payOrder.php?order_id=<?php echo $order['order_id']; ?>" class="pay edit-button">Pay</a>
                                <?php } ?>
                            </div>                        
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </main>
    <?php include './includes/footer.php'; ?>
</body>
</html>