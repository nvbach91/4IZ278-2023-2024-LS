<?php

require_once './classes/ProductDB.php';

session_start();

$productDB = new ProductDB();
$products = $productDB->find();

function correspondingProduct($product) {
    $cart = $_SESSION['cart'];
    if (in_array($product['good_id'], $cart)) {
        return true;
    } else {
        return false;
    }
}

$productsCart = array_filter($products, 'correspondingProduct');

?>

<?php include './include/header.php'; ?>
    <?php require './include/navbar.php'; ?>
        <!-- Page Content-->
        <div class="container">
            <h1>Cart</h1>
            <div class="col-lg-9"> 
                    <?php foreach($productsCart as $product): ?>                   
                        <div class="card" style="width: 18rem;">
                            <img class="card-img-top" src="<?php echo $product['img']; ?>" alt="Card image cap">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $product["name"]; ?></h5>
                                <h6 class="card-subtitle mb-2 text-muted"><?php echo $product["price"]; ?>$</h6>
                                <p class="card-text"><?php echo $product["description"]; ?></p>
                                <a href="./buy.php?good_id=<?php echo $product["good_id"] ?>" class="btn btn-primary">Do košíku</a>
                                <a href="edit-item.php?good_id=<?php echo $product["good_id"] ?>" class="btn btn-outline-primary">Upravit</a>
                                <a href="remove-item.php?good_id=<?php echo $product["good_id"] ?>" class="btn btn-outline-secondary">Odstranit z košíku</a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
        </div>
        <?php include './include/footer.php'; ?>