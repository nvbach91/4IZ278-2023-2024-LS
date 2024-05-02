<?php
require 'user_required.php';
require 'manager_required.php';
require_once 'db/GoodsDB.php';
$goodsDB = new GoodsDB();

include 'includes/head.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $good_id = $_POST['good_id'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $img = $_POST['img'];


    $goodsDB->update("UPDATE cv08_goods SET name = :name, price = :price, img = :img WHERE good_id = :good_id", ['name' => $name, 'price' => $price, 'img' => $img, 'good_id' => $good_id]);
    echo "Item updated successfully.";
}

$product = $goodsDB->find(['good_id' => $_GET['good_id']]);
?>

<form method="post">
    <input type="hidden" name="good_id" value="<?php echo isset($product['good_id']) ? $product['good_id'] : ''; ?>">
    Name: <input type="text" name="name" value="<?php echo isset($product['name']) ? $product['name'] : ''; ?>">
    Price: <input type="text" name="price" value="<?php echo isset($product['price']) ? $product['price'] : ''; ?>">
    Image URL: <input type="text" name="img" value="<?php echo isset($product['img']) ? $product['img'] : ''; ?>">
    <input type="submit" value="Update">
</form>
<?php include 'includes/foot.php'; ?>