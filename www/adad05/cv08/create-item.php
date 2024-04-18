<?php

include 'includes/head.php';
require 'classes/GoodsDB.php';

if (!empty($_POST)) {

    $goodsDB = new GoodsDB();
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
        $goodsDB->addProduct($name, $price, $description, $image);
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