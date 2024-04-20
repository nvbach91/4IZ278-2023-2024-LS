<?php
require 'user_required.php';

require_once 'db/GoodsDB.php';
$goodsDB = new GoodsDB();

include 'includes/head.php';
?>
<div class="buyMoreStuff"><a href="store.php">Buy more stuff</a></div>
<?php
if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
?>
    <div class="row">
        <?php
        foreach ($_SESSION['cart'] as $good_id) {
            $product = $goodsDB->find(['good_id' => $good_id]);
            if ($product) {
        ?>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card h-100">
                        <a href="#!"><img class="card-img-top" src="<?php echo $product['img']; ?>" alt="..."></a>
                        <div class="card-body">
                            <h4 class="card-title"><a href="#!"><?php echo $product['name']; ?></a></h4>
                            <h5><?php echo number_format($product['price'], 2) . ' ' . '€'; ?></h5>
                            <p class="card-text">Short description</p>
                        </div>
                        <div class="card-footer">
                            <a class="btn" href="remove-item.php?good_id=<?php echo $product['good_id']; ?>">Remove</a>
                        </div>
                    </div>
                </div>
        <?php
            } else {
                echo "Error: Product with ID $good_id not found.";
            }
        }
        ?>
    </div>
<?php
}
if (empty($_SESSION['cart'])) {
?>
    <div class="emptyCart">Your cart is empty.</div>
<?php
}
?>
<?php include 'includes/foot.php'; ?>