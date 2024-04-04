<?php
require_once ('db/db.php');
$db = new $categoriesDB;
$categories = $db->getCategories();
?>

<div class="col-lg-3">
    <h1 class="my-4">Hulba - baseball shop</h1>
    <div class="list-group">
        <a class="list-group-item" href="?">Všechny kategorie</a>
        <?php foreach ($categories as $category) {
            echo '<a class="list-group-item" href="?category=' . $category->category_id . '">' . $category->name . '</a>';
        } ?>
    </div>
</div>