<?php

require "./database/CategoriesDB.php";

$categoriesDB = new CategoriesDB();
$categories = $categoriesDB->find();

?>


<div class="col-lg-3">
    <h1 class="my-4">Kytary.cz</h1>
    <div class="list-group">
        <?php foreach ($categories as $category) : ?>
            <a class="list-group-item" href="?category_id=<?php echo $category["category_id"] ?>"><?php echo $category["name"] ?></a>
        <?php endforeach ?>
    </div>
</div>