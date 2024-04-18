<?php

require __DIR__ . "/database/ProductsDB.php";

session_start();

$productsDB = new ProductsDB();

if (isset($_GET['product_id'])) {
    $productId = $_GET['product_id'];
    $exists = $productsDB->exists(['product_id' => $productId]);
}

if ($exists) {
    $product = $productsDB->find(['product_id' => $productId]);
}

$name = $product['name'];
$price = $product['price'];
$description = $product['description'];
$image = $product['img'];

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
        $productsDB->update(['product_id' => $productId], ['name' => $name, 'price' => $price, 'description' => $description, 'img' => $image]);
        header("Location: index.php");
    }
}
?>

<?php include __DIR__ . '/includes/header.php'; ?>
<main>
    <?php if (!$exists) : ?>
        <h1>Product not found</h1>
    <?php else : ?>
        <h1>Edit item</h1>
        <?php require __DIR__ . '/components/ProductForm.php'; ?>
    <?php endif; ?>
</main>
<?php include __DIR__ . '/includes/footer.php'; ?>