<?php
require_once 'db/GoodsDB.php';
$goodsDB = new GoodsDB();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST['name']);
    $price = floatval(trim($_POST['price']));
    $description = trim($_POST['description']);
    $img = trim($_POST['img']);

    $goodsDB->create(['name' => $name, 'price' => $price, 'description' => $description, 'img' => $img]);
    header('Location: index.php');
    exit;
}
?>

<?php include 'includes/header.php'; ?>

<form method="post">
    Name: <input type="text" name="name">
    Price: <input type="text" name="price">
    Description: <textarea name="description"></textarea>
    Image URL: <input type="text" name="img">
    <input type="submit" value="Create">
</form>
<?php include 'includes/footer.php'; ?>