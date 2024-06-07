<?php 
require_once __DIR__ . '/../db/CategoriesDB.php'; 
?>
<?php

$categoriesDB = new CategoriesDB();
$categories = $categoriesDB->find();

?>

<div class="col-lg-3">
    <div class="list-group mt-5">
        <a href="." class="list-group-item list-group-item-action <?php echo !isset($_GET['category_id']) ? 'active' : ''; ?>">
            Všechny kategorie
        </a>
        <?php foreach($categories as $category): ?>
            <a href=".?category_id=<?php echo $category['category_id']; ?>" class="list-group-item list-group-item-action <?php echo (isset($_GET['category_id']) && $_GET['category_id'] == $category['category_id']) ? 'active' : ''; ?>">
                <?php echo htmlspecialchars($category['name']); ?>
            </a>
        <?php endforeach; ?>
    </div>
</div>
