<?php

require '../Controller/home.php';

?>

<?php include './includes/head.php'; ?>
<body>
    <?php require './includes/navbar.php'; ?>
    <main>
        <div class="container">
            <?php if (isset($userPrivilige) && $userPrivilige >= 1) { ?>
                <a href="new-product.php" class="create-button">Create new product</a>
            <?php } ?>
            <div class="product-container">
                <div class="categories">
                    <ul class="category-list">
                        <?php foreach ($categories as $category): ?>
                            <li class="category">
                                <a href="?category_id=<?php echo $category['category_id']; ?>"><?php echo $category['name']; ?></a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <div class="products">
                    <?php foreach ($products as $product): ?>
                    <div class="product">
                        <img class="product-image" src="<?php echo $product['img']; ?>" alt="Product image">
                        <div class="product-body">
                            <h5 class="product-name"><?php echo $product['name']; ?></h5>
                            <p class="product-description"><?php echo $product['description']; ?></p>
                            <div class="product-bodyend">
                                <a href="../Controller/addToWishlist.php?product_id=<?php echo $product['product_id']; ?>" class="product-button">Wishlist</a>
                                <p class="product-price"><?php echo $product['price'] . ' Kč'; ?></p>
                            </div>
                            <?php if (isset($userPrivilige) && $userPrivilige >= 1) { ?>
                                    <a href="edit-product.php?product_id=<?php echo $product['product_id']; ?>" class="edit-button">Edit Product</a>
                            <?php } ?>
                            <a href="../Controller/buyController.php?product_id=<?php echo $product['product_id']; ?>" class="edit-button">Buy</a>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </main>
    <?php include './includes/footer.php'; ?>
</body>
</html>