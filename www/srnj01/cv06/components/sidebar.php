<?php

require_once('db/eshop.php');
$db = new CategoriesDB();
$categories = $db->find();

?>

<h1 class="my-4">Shop Name</h1>
<div class="list-group">
  <a class="list-group-item" href="?ctg=0">All Categories</a>
  <?php foreach ($categories as $category) { ?>
    <a class="list-group-item" href="?ctg=<?php echo $category['id']; ?>"><?php echo $category['name']; ?></a>
  <?php } ?>
</div>
