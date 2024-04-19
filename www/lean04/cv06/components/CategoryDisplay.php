<?php

require __DIR__ . "/../database/CategoriesDB.php";

$categoriesDB = new CategoriesDB();
$categories = $categoriesDB->findAll();

?>

<div class="list-group">
    <a class="list-group-item" href=".">All mangos</a>
    <?php foreach ($categories as $category) : ?>
        <a class="list-group-item" href=<?php echo "?category_id=" . $category['category_id'] ?>>
            <?php echo $category['name'] ?> (<?php echo $category['number'] ?>)
        </a>
    <?php endforeach; ?>
</div>