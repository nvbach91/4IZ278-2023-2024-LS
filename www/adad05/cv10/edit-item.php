<?php

include 'includes/head.php';
require 'classes/GoodsDB.php';
require 'manager-required.php';

$email = $_COOKIE['username'];
$usersDB = new UsersDB();
$users = $usersDB->findByEmail($email);

if (!empty($_POST)) {

    $goodsDB = new GoodsDB();
    $id = htmlspecialchars(trim($_POST['good_id']));
    $name = htmlspecialchars(trim($_POST['name']));
    $price = htmlspecialchars(trim($_POST['price']));
    $description = htmlspecialchars(trim($_POST['description']));
    $image = htmlspecialchars(trim($_POST['image']));

    $errors = [];

    if (!filter_var($image, FILTER_VALIDATE_URL)) {
        array_push($errors, "Image URL muste be valid!");
    }

    if (strlen($name) < 4) {
        array_push($errors, "Name must be at least 4 characters!");
    }

    if (strlen($description) < 10) {
        array_push($errors, "Description must be at least 10 characters!");
    }

    if (!preg_match('/^[0-9]+$/', $price)) {
        array_push($errors, "Price must be numbers!");
    }

    if (count($errors) == 0) {
        $goodsDB->updateProduct($id, $name, $price, $description, $image);
        header("Location: index.php");
    } else {
        foreach ($errors as $error) {
            echo $error . '<br>';
        }
    }
}

?>



<div class="container container-products-margin">
    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <label>Product ID:</label><br>
        <input type="text" name="good_id" value="<?php echo isset($_GET['id']) ? $_GET['id'] : '' ?><?php echo isset($id) ? $id : '' ?>" readonly><br>
        <label>Name:</label><br>
        <input type="text" name="name" value="<?php echo isset($name) ? $name : '' ?>"><br>
        <label>Price:</label><br>
        <input type="text" name="price" value="<?php echo isset($price) ? $price : '' ?>"><br>
        <label>Description:</label><br>
        <input type="text" name="description" value="<?php echo isset($description) ? $description : '' ?>"><br>
        <label>Image reference:</label><br>
        <input type="text" name="image" value="<?php echo isset($image) ? $image : '' ?>"><br>
        <button class="btn btn-primary btn-new" type="submit">Submit</button>
    </form>
</div>



<?php include 'includes/footer.php'; ?>