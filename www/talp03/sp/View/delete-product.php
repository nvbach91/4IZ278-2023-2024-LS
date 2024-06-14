<?php
require '../Controller/verifyDelete.php';
?>

<?php include './includes/head.php'; ?>
<body>
    <?php require './includes/navbar.php'; ?>
    <main>
        <div class="container-cart">
            <div class="delete-product products">
                <div class="product">
                    <img class="product-image" src="<?php echo $product['img']; ?>" alt="Product image">
                    <div class="product-body">
                        <h5 class="product-name"><?php echo $product['name']; ?></h5>
                        <p class="product-description"><?php echo $product['description']; ?></p>
                        <div class="product-bodyend">
                            <p class="product-price"><?php echo $product['price'] . ' Kč'; ?></p>
                        </div>                        
                    </div>
                </div>
            </div>
            <div class="verify-buttons">
                <p>Do you really want to delete this product?</p>
                <div class="buttons">
                    <a href="index.php" class="edit-button">No</a>
                    <a href="../Controller/deleteProductController.php?product_id=<?php echo $product['product_id']; ?>" class="edit-button delete">Delete</a>
                </div>
            </div>
        </div>
    </main>
    <?php include './includes/footer.php'; ?>
</body>
</html>