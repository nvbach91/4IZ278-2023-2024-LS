<?php
require_once 'db/CategoriesDB.php';
$categoriesDB = new CategoriesDB();
$categories = $categoriesDB->findAll();
?>
<div class="list-group">
    <a href="index.php" class="list-group-item">All categories</a>
    <?php foreach($categories as $category): ?>
    <a href="index.php?category_id=<?php echo $category['category_id']; ?>" class="list-group-item">
        <?php echo '[', $category['category_id'], '] ', $category['name']; ?>
    </a>
    <?php endforeach; ?>
</div>