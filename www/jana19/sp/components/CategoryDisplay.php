<?php
require_once __DIR__ . '/../db/ProductsDB.php';
require_once __DIR__ . '/../db/CategoriesDB.php';

$categoriesDB = new CategoriesDB();
$categories = $categoriesDB->find();

?>



<div class="list-group">
    <a href="./index.php" class="list-group-item">Show All</a>
    <?php foreach ($categories as $category) : ?>
        <a class="list-group-item" href="?category_id=<?php echo $category['category_id']; ?>"><?php echo $category['name']; ?></a>
    <?php endforeach; ?>
</div>

