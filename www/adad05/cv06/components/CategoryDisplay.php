<?php

require 'classes/CategoriesDB.php';
$categoriesDB = new CategoriesDB();
$categories = $categoriesDB->find();

?>

<a class="list-group-item" href="?">All categories</a>
<?php foreach ($categories as $category) : ?>
    <a class="list-group-item" href="?category_id=<?php echo $category['category_id']; ?>"><?php echo $category['name']; ?></a>
<?php endforeach; ?>