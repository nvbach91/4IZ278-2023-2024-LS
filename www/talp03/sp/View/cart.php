<?php
require '../Controller/cartController.php';
?>

<?php include './includes/head.php'; ?>
<body>
    <?php require './includes/navbar.php'; ?>
    <main>
        <div class="container-cart">
            <div class="products">
                <?php foreach ($products as $product): ?>
                    <div class="product">
                        <img class="product-image" src="<?php echo $product['img']; ?>" alt="Product image">
                        <div class="product-body">
                            <h5 class="product-name"><?php echo $product['name']; ?></h5>
                            <p class="product-description"><?php echo $product['description']; ?></p>
                            <div class="product-bodyend">
                                <a href="../Controller/removeFromCart.php?product_id=<?php echo $product['product_id']; ?>" class="order-remove">Remove</a>
                                <p class="product-price"><?php echo $product['price'] . ' Kč'; ?></p>
                                
                            </div>                        
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="order-info">
                <p class="price-sum">Total price: <?php if (isset($priceSum)) {echo $priceSum;} else {echo 0;}?></p>
                <a href="../Controller/makeOrder.php?price=<?php echo $priceSum; ?>" class="edit-button">Order</a>
            </div>
        </div>
    </main>
    <?php include './includes/footer.php'; ?>
</body>
</html>