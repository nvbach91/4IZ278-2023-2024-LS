<?php 

require_once './classes/CategoryDB.php';

$categoriesDB = new CategoryDB();
$categories = $categoriesDB->find();

?>

<div class="list-group">
  <a class="list-group-item" href=".">All products</a>
  <?php foreach ($categories as $category) : ?>
    <a class="list-group-item" href="?category_id=<?php echo $category['category_id'] ?>"><?php echo $category['name'] ?></a>
  <?php endforeach; ?>
</div>