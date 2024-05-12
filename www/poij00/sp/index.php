<?php
session_start();
require_once './database/CategoriesDB.php';
require_once './database/ProductsDB.php';

$categoriesDB = new CategoriesDB();
$categories = $categoriesDB->find();



$productsDB = new ProductsDB();
if (isset($_GET['category_id'])) {
  $products = $productsDB->findByCategory($_GET['category_id']);
} else {
  $products = $productsDB->find();
}



$count = $productsDB->selectAll();

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="style.css">
    
    
    <title>Document</title>
</head>
<body>
        <header>
            <nav class="navbar-menu">
                <div class="navbar-menu-left">
                    <div class="eshop-icon"><a href="./index.php"><i class="fa-solid fa-dumbbell"></i></a></div>
                    <div class="eshop-name"><a>FitFactory</a></div>
                </div>
                <div class="navbar-menu-right">
                    <?php 
                        if(isset($_SESSION["user_id"])) {
                    ?>
                    <i class="fa-solid fa-cart-shopping"></i>
                    <i class="fa-solid fa-user"></i>
                    <a href="./logout.php"><i class="fa-solid fa-right-from-bracket"></i></a>
                    <?php
                        } else {
                    ?>
                    <i class="fa-solid fa-cart-shopping"></i>
                    <a href="./login.php"><i class="fa-solid fa-user"></i></a>
                    <?php
                        }
                    ?>
                </div>
            </nav>
        </header>
        <main>

            <div class="main-container">
                <nav class="navbar-cat">
                    <ul>
                    <?php foreach($categories as $category): ?>
                        <li>
                            <a href="?category_id=<?php echo $category['category_id']; ?>" class="list-group-item">
                                <?php echo '[', $category['category_name'], '] ', $category['name']; ?>
                            </a>

                        </li>
                    <?php endforeach; ?>
                    </ul>
                </nav>
                <div class="pagination">
    </div>
                <?php if ($count) { ?>
                <div class="products-container">
                <?php foreach($products as $product): ?>
                    <div class="product">
                        <div class="product-image">
                            <img src=<?php echo htmlspecialchars($product['image']) ?>></img>
                            
                        </div>
                        
                        <div class="product-info">
                                <p><?php echo htmlspecialchars($product['product_name']) ?></p>
                                <p><?php echo htmlspecialchars($product['price'] . " Kč") ?></p>
                                <i class="fa-solid fa-cart-shopping"></i>
                            
                        </div>
                    </div>
                    <?php endforeach ?>
                </div>
                <?php } ?>
            </div>
        </main>
</body>
</html>