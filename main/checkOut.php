<?php 
session_start();
require '../components/handleCart.php';
require '../database/OrdersDB.php';
require '../database/OrderItemsDB.php';
require '../components/userAutor.php';
require '../class/email.php';

if(!isset($_SESSION['user_id'])) {
    header('Location: login.php');

    ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
} 
  
?>

<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style2.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

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

<div class="main-container">
    
        <h1 class="checkout-h1">Vaše objednávka</h1>

        <?php
      if (!empty($products)){
        $sum=0;
        echo '<table class="checkout-table">
                <thead>
                  <tr>
                    <th></th>
                    <th>Název produktu</th>
                    <th>Počet kusů</th>
                    <th>Cena</th>
                  </tr>
                </thead>
                <tbody>';
        foreach ($products as $product){
          echo '  <tr>
                    <td class="center">
                    </td>
                    <td>'.htmlspecialchars($product['product_name']).'</td>
                    <td>'.$_SESSION['cart'][$product['product_id']].'</td>
                    <td class="right">'.$_SESSION['cart'][$product['product_id']]*$product['price']." Kč".'</td>
                  </tr>';
          $sum+=$_SESSION['cart'][$product['product_id']]*$product['price'];
        }


        echo '  </tbody>
                <tfoot>
                  <tr>
                    <td>Cena celkem</td>
                    <td></td>
                    <td class="right">'.$sum.'</td>
                    <td></td>
                  </tr>
                </tfoot>                
              </table>';
      }else{
        echo 'Žádné zboží v košíku.';
      }
      ?>
        
<?php if (!empty($_POST)) {

$street = htmlspecialchars(trim($_POST['street']));
$city = htmlspecialchars(trim($_POST['city']));
$postcode = htmlspecialchars(trim($_POST['postcode']));
$mobile = htmlspecialchars(trim($_POST['mobile']));


$errors = [];

if (empty($city)) {
    array_push($errors, 'Vložte validní název města!');
}

if (!preg_match('/^\p{L}[\p{L}\p{N}\/ ]*\p{N}$/u', $street)) {
    array_push($errors, 'Zadejte validní název ulice!');
}
  
if (!preg_match('/^[\p{L}]*$/u', $city)) {
    array_push($errors, 'Zadejte validní název města!');
}

if (!preg_match('/^[\d\s]+$/', $postcode)) {
  array_push($errors, 'Zadejte validní PSČ!');
}

if (!preg_match('/^[0-9]{3}\s[0-9]{3}\s[0-9]{3}$/', $mobile)) {
    array_push($errors, 'Zadejte validní telefonní číslo s mezerami!');
}




    if (count($errors) == 0) {
      $currentDateTime = new DateTime();  
      $currentDateTimeString = $currentDateTime->format('Y-m-d H:i:s');

      $data= array (
            'user_id' => $_SESSION['user_id'],
            'order_date' => $currentDateTimeString,
            'status' => 'vyřizování',
            'total_price' => $sum
      );


        $ordersDB->create($data);

      foreach($products as $product) {
      $data2 = array (
          'order_id' => $ordersDB->findLast($_SESSION['user_id']),
          'product_id' => $product['product_id'],
          'quantity' => $_SESSION['cart'][$product['product_id']],
          'unit_price' => $product['price']
      );

      $orderItemsDB->create($data2);
      }

      unset($_SESSION['cart']);

      $email->sendEmail('Potvrzení objednávky', file_get_contents('../components/mail-template.php'));

      
    
        echo "<div class='registration-success' style='text-align: center;'>";
        echo "<p>Vaše objednávka byla úspěšně dokočena!</p>";
        echo "<a href='../main/index.php'>Přejít na hlavní stránku.</a>";
        echo "</div>"; 
    } 


} ?>
    
    <?php if (!empty($errors)): ?>
                <div class="form-errors checkout">
                <?php foreach($errors as $error): ?>
                    <p class="form-error"><?php echo $error; ?></p>
                <?php endforeach; ?>
                </div>
            <?php endif; ?>

    <form action="<?php echo $_SERVER['PHP_SELF']  ?>" method="POST" class="login-form checkout">
        <label for="street" class="login-label">Ulice a popisné číslo</label>
        <input type="text" name="street" id="street" class="login-input">
        <label for="city" class="login-label">Město</label>
        <input type="text" name="city" id="city" class="login-input">
        <label for="postcode" class="login-label">PSČ</label>
        <input type="text" name="postcode" id="postcode" class="login-input">
        <label for="mobile" class="login-label">Telefonní číslo</label>
        <input type="text" name="mobile" id="mobile" class="login-input">
        <button type="submit" name="submit">Potvrdit objednávku</button>
    </form>
 </div>
</body>
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

</html>