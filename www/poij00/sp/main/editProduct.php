<?php 
session_start();
require '../database/ProductsDB.php';
require '../components/userAutor.php';

if (isAdmin($loggedInUser) == false) {
    header('Location: ./index.php');
}

if(isset($_GET['product_id'])) {
    $productId = $_GET['product_id'];
}

$productResult = $productsDB->findBy('product_id', $productId);


if (!empty($_POST)) {

    $productName = htmlspecialchars(trim($_POST['productname']));
    $product_id = htmlspecialchars(trim($_POST['product']));
    $productPrice = htmlspecialchars(trim($_POST['productprice']));
    $productImage = htmlspecialchars(trim($_POST['productpic']));
    
    
    $errors = [];
    
    if (empty($productName)) {
        array_push($errors, 'Vložte validní název produktu!');
    }

    if (empty($productPrice)) {
        array_push($errors, 'Vložte validní cenu produktu!');
    }

    if (empty($productImage)) {
        array_push($errors, 'Vložte validní url adresu obrázku produktu!');
    }
    
    if (!preg_match('/^[a-zA-Z]*$/', $productName)) {
        array_push($errors, 'Vložte validní název produktu!');
    }

    if (!preg_match('/^[0-9]+$/', $productPrice)) {
        array_push($errors, 'Vložte validní cenu produktu!');
    }

    if (!preg_match('/\b(https?:\/\/\S+\.(?:jpg|jpeg|png|gif|bmp))\b/i', $productImage)) {
        array_push($errors, 'Vložte validní url adresu obrázku!');
    }
    
    

        if (count($errors) == 0) {
   
            $productsDB->update($product_id, $productName, $productPrice, $productImage);
            echo "<div class='registration-success' style='text-align: center;'>";
            echo "<p>Produkt byl úspěšně změněn!</p>";
            echo "<a href='./index.php'><button>Pokračovat zpět na hlavní stránku</button></a>";
            echo "</div>"; 
        } 

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

  <h1 class="editproduct-h1">Změna produktu</h1>

<?php if (!empty($errors)): ?>
                <div class="form-errors">
                <?php foreach($errors as $error): ?>
                    <p class="form-error"><?php echo $error; ?></p>
                <?php endforeach; ?>
                </div>
            <?php endif; ?>
<form action="<?php echo $_SERVER['PHP_SELF']  ?>" method="POST" class="login-form">
                <label for="productname" class="login-label">Název produktu</label>
                <input type="text" name="productname" id="productname" class="login-input" value="<?php echo htmlspecialchars($productResult[0]['product_name']) ?>">
                <label for="productprice" class="login-label">Cena produktu</label>
                <input type="text" name="productprice" id="productprice" class="login-input" value="<?php echo htmlspecialchars($productResult[0]['price']) ?>">
                <label for="productpic" class="login-label">Fotografie produktu</label>
                <input type="text" name="productpic" id="productpic" class="login-input" value="<?php echo htmlspecialchars($productResult[0]['image']) ?>">
                <input type="text" hidden name="productid" value="<?php echo $productId ?>">
                <button type="submit" name="submit" class="login-register">Učinit změny</button>
            </form>
            </div>
</body>
</html>