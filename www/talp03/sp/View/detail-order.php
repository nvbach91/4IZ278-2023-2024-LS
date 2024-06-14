<?php
require_once '../Controller/entryPrivilege.php';
require '../Controller/detailOrderController.php';
?>

<?php include './includes/head.php'; ?>
<body>
    <?php require './includes/navbar.php'; ?>
    <main>
        <div class="container-cart">
            <div>
                <h5 class="order-id"><?php echo 'Order number: ' . $order['order_id']; ?></h5>
                <p class="order-date"><?php echo $order['date']; ?></p>
                <p class="order-date"><?php echo 'User id: ' . $order['user_id']; ?></p>
            </div>
            <div class="products">
                <?php foreach ($productArray as $product) { ?>
                    <div class="order">
                        <div class="order-body">
                            <div class="order-bodystart">
                                <h5 class="order-id"><?php echo $product['name']; ?></h5>
                                <p class="order-date"><?php echo 'Product id: ' . $product['product_id']; ?></p>
                            </div>
                            <div class="order-bodyend">
                            <img class="product-image" src="<?php echo $product['img']; ?>" alt="Product image">
                                <p class="order-price"><?php echo $product['description']; ?></p>
                                <p class="order-state"><?php echo $product['price'] . ' Kč'; ?></p>
                                <p class="order-state"><?php echo 'Quantity: ' . $product['quantity']; ?></p>
                            </div>                        
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </main>
    <?php include './includes/footer.php'; ?>
</body>
</html>