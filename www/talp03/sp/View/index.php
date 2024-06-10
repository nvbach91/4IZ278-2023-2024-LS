<?php

require '../Controller/home.php';
require_once '../Controller/userPrivilege.php';

?>

<?php include './includes/head.php'; ?>
<body>
    <?php require './includes/navbar.php'; ?>
    <main>
        <div class="container">
            <?php if (isset($privilege) && $privilege['privilege'] >= 1) { ?>
                <a href="new-product.php" class="create-button">Create new product</a>
            <?php } ?>
            <div class="main-container">
                <div class="categories">
                    <ul class="category-list">
                        <?php foreach ($categories as $category): ?>
                            <li class="category">
                                <a href="?category_id=<?php echo $category['category_id']; ?>"><?php echo $category['name']; ?></a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <div class="products-container">
                    <div class="products">
                        <?php foreach ($itemsPerPage as $product): ?>
                        <div class="product">
                            <img class="product-image" src="<?php echo $product['img']; ?>" alt="Product image">
                            <div class="product-body">
                                <h5 class="product-name"><?php echo $product['name']; ?></h5>
                                <p class="product-description"><?php echo $product['description']; ?></p>
                                <div class="product-bodyend">
                                    <a href="../Controller/addToWishlist.php?product_id=<?php echo $product['product_id']; ?>" class="product-button">Wishlist</a>
                                    <p class="product-price"><?php echo $product['price'] . ' Kč'; ?></p>
                                </div>
                                <?php if (isset($privilege) && $privilege['privilege'] >= 1) { ?>
                                    <a href="edit-product.php?product_id=<?php echo $product['product_id']; ?>" class="edit-button">Edit Product</a>
                                    <a href="delete-product.php?product_id=<?php echo $product['product_id']; ?>" class="edit-button delete">Delete Product</a>
                                <?php } ?>
                                    <a href="../Controller/buyController.php?product_id=<?php echo $product['product_id']; ?>" class="edit-button">Buy</a>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                    <div class="pagination">
                        <?php for($i = 0; $i < $nPaginations; $i++) {?>
                            <a href="?page=<?php echo $i +1; ?>"><?php echo $i +1; ?></a>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <?php include './includes/footer.php'; ?>
</body>
</html>