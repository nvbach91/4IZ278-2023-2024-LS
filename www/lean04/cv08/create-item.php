<?php

require __DIR__ . "/database/ProductsDB.php";

session_start();

$productsDB = new ProductsDB();

if (!empty($_POST)) {
    $name = htmlspecialchars(trim($_POST["name"]));
    $price = htmlspecialchars(trim($_POST["price"]));
    $description = htmlspecialchars(trim($_POST["description"]));
    $image = htmlspecialchars(trim($_POST["image"]));

    $errors = [];

    if (empty($name)) {
        array_push($errors, "Name is required");
    } elseif (strlen($name) < 3) {
        array_push($errors, "Name must have 3 or more characters");
    }

    if (empty($price)) {
        array_push($errors, "Price is required");
    } elseif (!filter_var($price, FILTER_VALIDATE_FLOAT)) {
        array_push($errors, "Price must be a number");
    }

    if (empty($image)) {
        array_push($errors, "Image URL is required");
    } elseif (!filter_var($image, FILTER_VALIDATE_URL)) {
        array_push($errors, "'$image' is not a valid URL");
    }

    if (count($errors) == 0) {
        $productsDB->create(['name' => $name, 'price' => $price, 'description' => $description, 'img' => $image]);
        header("Location: index.php");
    }
}
?>

<?php include __DIR__ . '/includes/header.php'; ?>
<main>
    <h1>Create item</h1>
    <?php require __DIR__ . '/components/ProductForm.php'; ?>
</main>
<?php include __DIR__ . '/includes/footer.php'; ?>