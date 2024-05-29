<?php require __DIR__ . '/../includes/header.php'; ?>
<?php
require_once __DIR__ . '/../db/ProductsDatabase.php';

$currentUrlParams = $_SERVER['QUERY_STRING'];

$urlParamsArr = explode("&", $currentUrlParams);



$idProduct = 0;
for($i = 0; $i < count($urlParamsArr); $i++){
    if(str_contains($urlParamsArr[$i], 'id')){
        $idProduct = explode('=',$urlParamsArr[$i])[1];
    }
}

$productsDB = new ProductsDatabase();
$types = $productsDB->readAllProductTypes();

$product = null;
$productTypes = [];


if ($idProduct != 0) {
    $product = $productsDB->readProductById($idProduct);
    $product = $product[0]; // Accessing the first element of the array
    $productTypes = $productsDB->readProductTypes($idProduct);
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collecting form data
    $name = $_POST['name'];
    $price = (int)$_POST['price'];
    $discount = (int)$_POST['discount'];
    $isAvailable = isset($_POST['isAvailable']) ? 1 : 0;
    $isCaffeineFree = isset($_POST['isCaffeineFree']) ? 1 : 0;
    $isGiftSet = isset($_POST['isGiftSet']) ? 1 : 0;
    $image = $_POST['image'];
    $description = $_POST['description'];
    $selectedTypes = $_POST['types']; // Array of selected types


    $result = $productsDB->updateProduct($idProduct, $name, $price, $discount, $isAvailable, $isCaffeineFree, $isGiftSet, $image, $description, $selectedTypes); 

    

    if ($result) {
        echo "Product updated successfully!";
        $locationUrl = "../details.php?productId=" . $idProduct;
        header("Location: $locationUrl");
    } else {
        echo "Error: Could not update product.";
        header("Location: ../index.php");
    }
}
?>

<main class="container">
    <h1 class="my-4">Edit Product</h1>
    <?php if ($product): ?>
    <form action="" method="POST">
        <input type="hidden" name="id" value="<?= htmlspecialchars($product['idProduct'] ?? ''); ?>">

        <label for="name">Product Name:</label>
        <input type="text" id="name" name="name" value="<?= htmlspecialchars($product['name'] ?? ''); ?>" required><br><br>

        <label for="price">Price:</label>
        <input type="number" id="price" name="price" value="<?= htmlspecialchars($product['price'] ?? ''); ?>" required><br><br>

        <label for="discount">Discount:</label>
        <input type="number" id="discount" name="discount" value="<?= htmlspecialchars($product['discount'] ?? ''); ?>" required><br><br>

        <label for="isAvailable">Available:</label>
        <input type="checkbox" id="isAvailable" name="isAvailable" <?= ($product['isAvailable'] ?? false) ? 'checked' : ''; ?>><br><br>

        <label for="isCaffeineFree">Caffeine Free:</label>
        <input type="checkbox" id="isCaffeineFree" name="isCaffeineFree" <?= ($product['isCaffeineFree'] ?? false) ? 'checked' : ''; ?>><br><br>

        <label for="isGiftSet">Gift Set:</label>
        <input type="checkbox" id="isGiftSet" name="isGiftSet" <?= ($product['isGiftSet'] ?? false) ? 'checked' : ''; ?>><br><br>

        <label for="image">Image URL:</label>
        <input type="text" id="image" name="image" value="<?= htmlspecialchars($product['image'] ?? ''); ?>" required><br><br>

        <label for="description">Description:</label>
        <textarea id="description" name="description" required><?= htmlspecialchars($product['description'] ?? ''); ?></textarea><br><br>

        <label for="types">Product Types:</label>
        <select id="types" name="types[]" multiple required>
            <?php foreach ($types as $type): ?>
                <option value="<?= $type['idProductType']; ?>" <?= in_array($type['idProductType'], array_column($productTypes, 'idProductType')) ? 'selected' : ''; ?>><?= htmlspecialchars($type['typeName']); ?></option>
            <?php endforeach; ?>
        </select><br><br>

        <input class="btn btn-danger" type="submit" value="Update Product">
    </form>
    <?php else: ?>
        <p>Product not found.</p>
    <?php endif; ?>
    <br>
</main>

<?php require __DIR__ . '/../includes/footer.php'; ?>
