<?php 
require '../database/ProductsDB.php';
require '../components/userAutor.php';


if (!empty($_POST)) {

    $productName = htmlspecialchars(trim($_POST['productname']));
    $productPrice = intval(htmlspecialchars(trim($_POST['productprice'])));
    $productImage = htmlspecialchars(trim($_POST['productpic']));
    $productDescription = htmlspecialchars(trim($_POST['productdescr']));
    $productCategory = htmlspecialchars(trim($_POST['productcat']));
    
    
    $errors = [];
    
    if (empty($productName)) {
        array_push($errors, 'Vložte validní název produktu!');
    }
    
    if (!preg_match('/^[\p{L} ]*$/u', $productName)) {
        array_push($errors, 'Vložte validní název produktu!');
    }

    if (!preg_match('/^[0-9]+$/', $productPrice)) {
        array_push($errors, 'Vložte validní cenu produktu!');
    }

    if (!preg_match('/\b(https?:\/\/\S+\.(?:jpg|jpeg|png|gif|bmp))\b/i', $productImage)) {
        array_push($errors, 'Vložte validní url adresu obrázku!');
    }

    if (!preg_match('/^[\p{L} !?.(),\[\]{}]*$/u', $productDescription)) {
        array_push($errors, 'Vložte validní popisek produktu!');
    }


    if (!preg_match('/^[0-9]+$/', $productCategory)) {
        array_push($errors, 'Vložte validní id kategorie produktu!');
    }
    
    
   
        if (count($errors) == 0) {
            $data = array(
                'product_name' => $productName,
                'price' => $productPrice,
                'image' => $productImage,
                'description' => $productDescription,
                'category_id' => $productCategory
            );
            $productsDB->create($data);
            echo "<div class='registration-success' style='text-align: center;'>";
            echo "<p>Produkt byl úspěšně vytvořen!</p>";
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

    <title></title>
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
<h1 class="addproduct-h1">Přidat nový produkt</h1>
    <?php if (!empty($errors)): ?>
         <div class="form-errors">
             <?php foreach($errors as $error): ?>
                 <p class="form-error"><?php echo $error; ?></p>
            <?php endforeach; ?>
        </div>
     <?php endif; ?>
     
    <form action="<?php echo $_SERVER['PHP_SELF']  ?>" method="POST" class="login-form">
        <label for="productname" class="login-label">Název produktu</label>
        <input type="text" name="productname" id="productname" class="login-input">
        <label for="productprice" class="login-label">Cena produktu</label>
        <input type="text" name="productprice" id="productprice" class="login-input">
        <label for="productpic" class="login-label">Fotografie produktu</label>
        <input type="text" name="productpic" id="productpic" class="login-input">
        <label for="productdescr" class="login-label">Popisek produktu</label>
        <input type="text" name="productdescr" id="productdescr" class="login-input">
        <label for="productcat" class="login-label">Kategorie produktu</label>
        <input type="text" name="productcat" id="productcat" class="login-input">
        <button type="submit" name="submit">Vytvořit nový produkt</button>
    </form>
    </div>
</body>
</html>