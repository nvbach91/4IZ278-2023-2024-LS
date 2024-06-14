<?php
require '../Controller/wishlistController.php';
?>

<?php include './includes/head.php'; ?>
<body>
    <?php require './includes/navbar.php'; ?>
    <main>
        <div class="container-cart">
            <div class="products">
                <?php if (!empty($products)) { ?>
                    <?php foreach ($products as $product): ?>
                        <div class="product">
                            <img class="product-image" src="<?php echo $product['img']; ?>" alt="Product image">
                            <div class="product-body">
                                <h5 class="product-name"><?php echo $product['name']; ?></h5>
                                <p class="product-description"><?php echo $product['description']; ?></p>
                                <div class="product-bodyend">
                                    <a href="../Controller/removeFromWishlist.php?product_id=<?php echo $product['product_id']; ?>" class="order-remove">Remove</a>
                                    <p class="product-price"><?php echo $product['price'] . ' Kč'; ?></p>
                                </div>
                                <a href="../Controller/buyController.php?product_id=<?php echo $product['product_id']; ?>" class="edit-button">Buy</a>                        
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php } ?>
            </div>
        </div>
    </main>
    <?php include './includes/footer.php'; ?>
</body>
</html>