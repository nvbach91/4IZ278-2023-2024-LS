<?php
require 'user_required.php';
require 'manager_required.php';
require_once 'db/GoodsDB.php';
$goodsDB = new GoodsDB();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST['name']);
    $price = floatval(trim($_POST['price']));
    $description = trim($_POST['description']);
    $img = trim($_POST['img']);

    $goodsDB->create(['name' => $name, 'price' => $price, 'description' => $description, 'img' => $img]);
    header('Location: store.php');
    exit;
}
?>

<?php include 'includes/head.php'; ?>

<form method="post">
    Name: <input type="text" name="name">
    Price: <input type="text" name="price">
    Description: <textarea name="description"></textarea>
    Image URL: <input type="text" name="img">
    <input type="submit" value="Create">
</form>
<?php include 'includes/foot.php'; ?>