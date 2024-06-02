<?php 
require_once __DIR__ . '/../db/CategoriesDB.php'; 
?>
<?php

$categoriesDB = new CategoriesDB();
$categories = $categoriesDB->find();

?>

<div class="col-lg-3">
    <h1 class="my-4">Softball shop</h1>
    <div class="list-group">
    <a href="." class="list-group-item">Všechny kategorie</a>
    <?php foreach($categories as $category): ?>
    <a href=".?category_id=<?php echo $category['category_id']; ?>" class="list-group-item">
        <?php echo '[', $category['category_id'], '] ', $category['name']; ?>
    </a>
    <?php endforeach; ?>
</div>
</div>

