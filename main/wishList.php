<?php
session_start();
require '../components/handleWishlist.php';
require_once '../components/userAutor.php';
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <title>My shopping cart - PHP Shopping App</title>
    <link rel="stylesheet" href="../style2.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
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

		<div class="main-container">
            <h1 class="wishlist-h1">Můj wish list</h1>
            
            <div class="wishlist-cnt">Celkem produktů ve wish listu: <strong><?php echo (!empty($products)?count($products):'0'); ?></strong></div>
            
            <br/><br/>
            
            <a href="index.php" class="wishlist-move">Zpět na hlavní stránku</a>
            
            <br/><br/>
            <div class="container-main">
                <?php
                if (!empty($products)){ ?>
                    <div class="products-container">

                        <?php foreach ($products as $product): ?>
                                    <div class="product">
                                        <div class="product-image">
                                            <img src=<?php echo htmlspecialchars($product['image']) ?>></img>
                                            
                                        </div>
                                        
                                        <div class="product-info">
                                                <p><?php echo htmlspecialchars($product['product_name']) ?></p>
                                                <p><?php echo htmlspecialchars($product['price'] . " Kč") ?></p>
                                            
                                        </div>
                                    </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                    
                
            <?php
            }else{
                echo 'Zatím nemáte ve wish listu žádné produkty.';
            }
            ?>
    </div>
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