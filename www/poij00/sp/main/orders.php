<?php
session_start();
require '../database/OrdersDB.php';
require_once '../components/userAutor.php';

if (!isset($_SESSION['user_id'])) {
  header('Location: ./index.php');
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <title></title>
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
    <?php if (isAdmin($loggedInUser) == false){ ?>
	  <h1 class="orders-h1">Moje objednávky</h1>
    <?php } else {?>
      <h1 class="orders-h1"> Objednávky zákazníků</h1>
      <?php } ?>

<?php 

$allOrders = $ordersDB->findBy('user_id', $_SESSION['user_id']);
$adminOrders = $ordersDB->find();


if (isAdmin($loggedInUser) == false) {
if (!empty($allOrders)){
    echo '<table>
            <thead>
              <tr>
                <th>ID objednávky</th>
                <th>Datum objednávky</th>
                <th>Cena objednávky</th>
                <th>Stav objednávky</th>
              </tr>
            </thead>
            <tbody>';
    foreach ($allOrders as $order){
      echo '  <tr>
                <td>'.htmlspecialchars($order['order_id']).'</td>
                <td>'.htmlspecialchars($order['order_date']).'</td>
                <td>'.htmlspecialchars($order['total_price']).'</td>
                <td>'.htmlspecialchars($order['status']).'</td>
              </tr>';
    }
    echo '  </tbody>
            <tfoot>
              <tr>
                <td></td>
                <td></td>
              </tr>
            </tfoot>                
          </table>';
  }else{
    echo 'Neučinili jste dosud žádnou objednávku.';
  } 
} else if (isAdmin($loggedInUser) == true) {
  if (!empty($adminOrders)) {
    echo '<table>
    <thead>
      <tr>
        <th>ID objednávky</th>
        <th>Datum objednávky</th>
        <th>Cena objednávky</th>
        <th>Stav objednávky</th>
        <th></th>
      </tr>
    </thead>
    <tbody>';
foreach ($adminOrders as $order){
echo '  <tr>
        <td>'.htmlspecialchars($order['order_id']).'</td>
        <td>'.htmlspecialchars($order['order_date']).'</td>
        <td>'.htmlspecialchars($order['total_price']).'</td>
        <td>'.htmlspecialchars($order['status']).'</td>
        <td class="center">
        <a class="remove-btn" href="../components/handleState.php?order_id='.$order['order_id'].'">Změnit status</a>
      </td>
        </tr>';
}
echo '  </tbody>
    <tfoot>
      <tr>
        <td></td>
        <td></td>
      </tr>
    </tfoot>                
  </table>';
}else{
echo 'Nikdo zatím neudělal žádnou objednávku.';
  }
}
?>
<a href="index.php" class="orders-move">Zpět na hlavní stránku</a>

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
