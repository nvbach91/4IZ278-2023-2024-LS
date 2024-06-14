<?php
session_start();
require_once '../database/CategoriesDB.php';
require_once '../database/ProductsDB.php';
require_once '../components/userAutor.php';


$categories = $categoriesDB->find();

$productsDB = new ProductsDB();
if (isset($_GET['category_id'])) {
    $categoryId = $_GET['category_id'];
  $products = $productsDB->findByCategory($categoryId);
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
    <link rel="stylesheet" href="../style2.css">
    
    
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
                    <a href="./cart.php" class="cart-icon"><i class="fa-solid fa-cart-shopping"></i></a>
                    <?php
                        if (isAdmin($loggedInUser) == false) {
                            echo "<a href='./wishList.php' class='wishlist-icon'><i class='fa-solid fa-heart'></i></a>";
                        }
                    ?>
                    <a href="./orders.php"><i class="fa-solid fa-user"></i></a>
                    <a href="../components/logout.php"><i class="fa-solid fa-right-from-bracket"></i></a>
                    <?php
                        } else {
                    ?>
                    <a href="./cart.php"><i class="fa-solid fa-cart-shopping"></i></a>
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
                                <?php echo $category['category_name'] ?>
                            </a>

                        </li>
                    <?php endforeach; ?>
                    </ul>
                </nav>
                <?php 
                if(isset($_SESSION['user_id'])) {

                    if (isAdmin($loggedInUser) == true) {
                        echo "<a href='./addProduct.php' class='addproduct-btn'>Přidat nový produkt</a>";
                    }
                }

                ?>
 
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
                                <form action="../components/AddToCart.php" method="POST">
                                <input type="number" name="quantity" id="quantity" value= "1" min="1">
                                <input type="hidden" name="product_id" value="<?php echo htmlspecialchars($product['product_id']) ?>">
                                <button type="submit" class="add-to-cart-btn">Přidat do košíku</button>
                                </form>
                                <?php 
                                if (isset($_SESSION['user_id'])){
                                    if (isAdmin($loggedInUser) == true) {
                                        echo "<a href='./editProduct.php?product_id=" .htmlspecialchars($product['product_id']) ."' class='editproduct-btn'>Upravit</a>";
                                        echo "<a href='../components/deleteProduct.php?product_id=" .htmlspecialchars($product['product_id']) ."' class='deleteproduct-btn'>Smazat</a>";
                                    } else {
                                        echo "<a href='../components/addToWishlist.php?product_id=" .htmlspecialchars($product['product_id']) ."' class='wishlist'>Wishlist</a>";
                                    }

                                }
                                ?>
                                <!-- <i class="fa-solid fa-cart-shopping"></i> -->
                            
                        </div>
                    </div>
                    <?php endforeach ?>
                </div>
                <?php } ?>
            </div>
        </main>

        <footer class="footer">
        <div class="footer-container">
            <div class="footer-column">
                <h3>Kontaktujte nás</h3>
                <p>Email: info@fitfactory.cz</p>
                <p>Telefon: +420 733 222 455</p>
                <p>Adresa: Francouzska 2576/18, 120 00 Praha</p>
            </div>
            <div class="footer-column">
                <h3>Rychlé odkazy</h3>
                <ul>
                    <li><a href="">O nás</a></li>
                    <li><a href="">Obchod</a></li>
                    <li><a href="">Blog</a></li>
                    <li><a href="">Kontakt</a></li>
                    <li><a href="">FAQ</a></li>
                </ul>
            </div>
            <div class="footer-column">
                <h3>Sledujte nás</h3>
                <div class="social-icons">
                    <a href="" target="_blank">Facebook</a>
                    <a href="" target="_blank">Twitter</a>
                    <a href="" target="_blank">Instagram</a>
                    <a href="" target="_blank">YouTube</a>
                </div>
            </div>
            <div class="footer-column">
                <h3>Newsletter</h3>
                <form class="newsletter">
                    <input type="email" placeholder="Váš email">
                    <button type="submit">Přihlásit se</button>
                </form>
            </div>
        </div>
        <p>&copy; 2024 FitFactory. Všechna práva vyhrazena.</p>
    </footer>
</body>
</html>