<?php
require_once __DIR__ . '/../db/ProductsDatabase.php';


$productsDB = new ProductsDatabase();
$productTypes = $productsDB->readAllProductTypes();

?>



<div class="list-group">
    <a href="./index.php" class="list-group-item">Show All</a>
    <?php foreach ($productTypes as $productType) : ?>
        <a class="list-group-item" href="?idProductType=<?php echo $productType['idProductType']; ?>"><?php echo $productType['typeName']; ?></a>
    <?php endforeach; ?>
</div>

