<?php 
require '../database/OrdersDB.php';
require './userAutor.php';

// if (isAdmin($loggedInUser) == false) {
//     header('Location: ../main/index.php');
// }

$orderId = $_GET['order_id'];

if (!empty($_POST)) {
    $stavObjednavky = htmlspecialchars(trim($_POST['stav']));
    $order = htmlspecialchars(trim($_POST['orderid']));

    $ordersDB->update($order, $stavObjednavky);
}




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
                    <div class="eshop-icon"><a href="../main/index.php"><i class="fa-solid fa-dumbbell"></i></a></div>
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
<form action="<?php echo $_SERVER['PHP_SELF']  ?>" method="POST" class="login-form state">
                <label for="stav" class="login-label">Stav objednávky</label>
                <select name="stav" id="stav">
                    <option value="vyřizování">vyřízenování</option>
                    <option value="připravuje se">připravuje se</option>
                    <option value="odeslaná">odeslaná</option>
                </select>
                <input  hidden type="text" name="orderid" value="<?php echo $orderId?>">
                <button type="submit" name="submit">Změnit stav</button>
            </form>
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