<?php



include 'includes/head.php';
session_start();


require 'classes/GoodsDB.php';
$goodsDB = new GoodsDB();
$cartEmpty = true;
$cartProducts = [];
if (count($_SESSION['cart']) > 0) {
    $cartProducts = $_SESSION['cart'];
    $cartEmpty = false;
}

?>

<div class="container container-products-margin">
    <?php if ($cartEmpty) { ?>
        <h2 class="title-margin-bot">Your cart is empty!</h2>
    <?php } else { ?>
        <h2 class="title-margin-bot">Your cart:</h2>
    <?php } ?>
    <div class="row">
        <div class="col-lg-9">
            <div class="row">
                <?php foreach ($cartProducts as $product) : ?>
                    <?php $item = $goodsDB->checkProductByID($product)[0] ?>
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="card h-100">
                            <img class="card-img-top" src="<?php echo $item['img']; ?>" alt="...">
                            <div class="card-body">
                                <h4 class="card-title"><a href="#!"><?php echo $item['name']; ?></a></h4>
                                <h5><?php echo $item['price']; ?> Kč</h5>
                                <p class="card-text"><?php echo $item['description']; ?></p>
                                <div>
                                    <a class="page-ref" href="remove-item.php?id=<?php echo $item['good_id'] ?>">Remove from cart</a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>


<?php include 'includes/footer.php'; ?>