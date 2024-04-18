<?php

require_once __DIR__ . '/../db/CategoriesDB.php';

$categoriesDb = new CategoriesDB();
$categories = $categoriesDb->find();

?>

<div class="list-group">
	<a class="list-group-item" href=".">Všechny tramvaje</a>
	<?php foreach ($categories as $category): ?>
	<a class="list-group-item" href="?category_id=<?php echo $category['category_id'] ?>"><?php echo $category['name'] ?></a>
	<?php endforeach; ?>
</div>
