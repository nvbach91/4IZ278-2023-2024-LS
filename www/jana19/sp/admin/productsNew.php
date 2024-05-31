<?php require __DIR__ . '/../includes/header.php'; ?>
<?php
require_once __DIR__ . '/../db/ProductsDatabase.php';

$productsDB = new ProductsDatabase();
$types = $productsDB->readAllProductTypes();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collecting form data
    $name = htmlspecialchars(trim($_POST['name']));
    $price = (int)$_POST['price'];
    $discount = (int)$_POST['discount'];
    $isAvailable = isset($_POST['isAvailable']) ? 1 : 0;
    $isCaffeineFree = isset($_POST['isCaffeineFree']) ? 1 : 0;
    $isGiftSet = isset($_POST['isGiftSet']) ? 1 : 0;
    $image = htmlspecialchars(trim($_POST['image']));
    $description = htmlspecialchars(trim($_POST['description']));
    $selectedTypes = $_POST['types']; // Array of selected types

    $errors = [];

    if (!filter_var($image, FILTER_VALIDATE_URL)) {
        array_push($errors, "<b>$image</b> is not a valid URL!");
    }

    if ($price <= 0) {
        array_push($errors, "<b>$price</b> – must be 1 or more!");
    }

    if ($discount < 0) {
        array_push($errors, "<b>$discount</b> – must be 0 or more!");
    }

    if (count($errors) == 0) {
        $result = $productsDB->createProduct($name, $price, $discount, $isAvailable, $isCaffeineFree, $isGiftSet, $image, $description, $selectedTypes);

        if ($result) {
            echo "New product added successfully!";
            header("Location: ../index.php");
        } else {
            echo "Error: Could not add product.";
        }
    }
}
?>
<main class="container">
    <h1 class="my-4">Add a new Product</h1>
    <br>
    <?php if (!empty($errors)) : ?>
        <div class="form-errors">
            <?php foreach ($errors as $error) : ?>
                <p class="form-error"><?php echo $error; ?></p>
            <?php endforeach; ?>
        </div>
    <?php endif ?>
    <br>
    <form action="" method="POST">
        <label for="name">Product Name:</label>
        <input type="text" id="name" name="name" required><br><br>

        <label for="price">Price:</label>
        <input type="number" id="price" name="price" required><br><br>

        <label for="discount">Discount:</label>
        <input type="number" id="discount" name="discount" required><br><br>

        <label for="isAvailable">Available:</label>
        <input type="checkbox" id="isAvailable" name="isAvailable"><br><br>

        <label for="isCaffeineFree">Caffeine Free:</label>
        <input type="checkbox" id="isCaffeineFree" name="isCaffeineFree"><br><br>

        <label for="isGiftSet">Gift Set:</label>
        <input type="checkbox" id="isGiftSet" name="isGiftSet"><br><br>

        <label for="image">Image URL:</label>
        <input type="text" id="image" name="image" required><br><br>

        <label for="description">Description:</label>
        <textarea id="description" name="description" required></textarea><br><br>

        <label for="types">Product Types:</label>
        <select id="types" name="types[]" multiple required>
            <?php foreach ($types as $type) : ?>
                <option value="<?= $type['idProductType']; ?>"><?= htmlspecialchars($type['typeName']); ?></option>
            <?php endforeach; ?>
        </select><br><br>

        <input class="btn btn-secondary" type="submit" value="Add Product">
    </form>
    <br>
</main>
<?php require __DIR__ . '/../includes/footer.php'; ?>