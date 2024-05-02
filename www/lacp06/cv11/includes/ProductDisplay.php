<?php

require_once './db/database_eshop.php';

$productsDB = new ProductsDB();
$userDB = new UsersDB();

if (isset($_COOKIE["name"])) {
  $user = $userDB->findUser($_COOKIE['name']);
  $privileges = $user['privileges'];
} else {
  $privileges = 0;
}

$nItems = $productsDB->countAllProducts();
$items = $productsDB->find([]);
$nItemsPerPage = 5;
$nPaginations = ceil($nItems / $nItemsPerPage);

if (isset($_GET["page"])) {
  $page = $_GET["page"];
  $offset = ($page - 1) * $nItemsPerPage;
} else {
  $page = 1;
  $offset = 0;
}
$products = $productsDB->findItemsPage($nItemsPerPage, $offset);
?>
<?php if ($privileges == 3) : ?>
  <a href="create-item.php">
    <button class="btn btn-primary" style="margin-top: 15px; margin-bottom: 15px;">Create Item</button>
  </a>
<?php endif; ?>
<ul class="pagination" style="display: flex; flex-wrap: wrap;">
  <?php for ($i = 0; $i < $nPaginations; $i++) : ?>
    <li class="page-item"><a class="page-link" href="?page=<?php echo $i + 1; ?>"><?php echo $i + 1; ?></a></li>
  <?php endfor; ?>
</ul>
<div class="row">
  <?php foreach ($products as $product) : ?>
    <div class="card" style="width: 18rem;">
      <img class="card-img-top" height="300" src="<?php echo $product['img'] ? $product['img'] : "https://upload.wikimedia.org/wikipedia/commons/thumb/1/1b/Svelte_Logo.svg/1200px-Svelte_Logo.svg.png" ?>" alt="<?php echo $product['name'] ?>">
      <div class="card-body">
        <h5 class="card-title"><a href="#!"><?php echo $product['name'] ?></a></h5>
        <h6><?php echo $product['price']; ?>&nbsp;Kč</h6>
        <p class="card-text">
          <?php echo $product['description']; ?>
        </p>
        <?php if (isset($_COOKIE['name'])) : ?>
          <a href="edit-item-optimistic.php?good_id=<?php echo $product['good_id']; ?>" class="btn btn-primary">Edit Optimistic</a>
          <a href="edit-item-pesimistic.php?good_id=<?php echo $product['good_id']; ?>" class="btn btn-primary">Edit Pesimistic</a>
        <?php endif; ?>
      </div>
    </div>
  <?php endforeach; ?>
</div>
<ul class="pagination" style="display: flex; flex-wrap: wrap;">
  <?php for ($i = 0; $i < $nPaginations; $i++) : ?>
    <li class="page-item"><a class="page-link" href="?page=<?php echo $i + 1; ?>"><?php echo $i + 1; ?></a></li>
  <?php endfor; ?>
</ul>