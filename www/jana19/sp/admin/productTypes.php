<?php require __DIR__ . '/../includes/header.php'; ?>
<?php
require_once __DIR__ . '/../db/ProductsDatabase.php';

$productsDB = new ProductsDatabase();
$types = $productsDB->readAllProductTypes();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['deleteProduct'])) {
        // Handle delete product type
        $typeId = $_POST['typeId'];
        $result = $productsDB->deleteProductTypeById($typeId);
        
        if ($result) {
            echo "Product type deleted successfully!";
            header("Location: " . $_SERVER['REQUEST_URI']);
            exit();
        } else {
            echo "Error: Could not delete product type.";
        }
    } else {
        // Handle adding new product type
        $newType = $_POST['type']; // Array of selected types
        $countNames = $productsDB->readAllProductTypesByName($newType);

        if ($countNames > 0) {
            // The product type exists
            echo "Error: Could not add product type. A type of this Name already exists.";
        } else {
            // The product type does not exist
            $result = $productsDB->createProductType($newType);

            if ($result) {
                echo "New product type added successfully!";
                header("Location: " . $_SERVER['REQUEST_URI']);
                exit();
            } else {
                echo "Error: Could not add product type.";
            }
        }
    }
}
?>
<main class="container">
    <h1 class="my-4">Add a new Product Type</h1>
    <div>
        <h2>Already existing product types: </h2>
        <div class="list-group">
            <?php foreach ($types as $type) : ?>
                <div class="list-group-item">
                    <form method="POST" action="">
                        <span>ID <?= number_format($type['idProductType'], 0); ?>: <?= htmlspecialchars($type['typeName']); ?></span>
                        
                        <button class="btn btn-danger float-right" type="submit" name="deleteProduct">Delete</button>
                        <input type="hidden" name="typeId" value="<?= number_format($type['idProductType'],0); ?>">
                    </form>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <br><br>
    <div>
        <h2>Add a new product type: </h2>
        <form action="" method="POST">
            <label for="types">New product Type:</label>
            <input id="type" name="type" type="text">
            <br><br>

            <input class="btn btn-secondary" type="submit" value="Add Product Type">
        </form>
    </div>

    <br>
</main>
<?php require __DIR__ . '/../includes/footer.php'; ?>