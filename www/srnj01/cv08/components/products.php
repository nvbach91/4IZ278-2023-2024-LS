<?php

require_once('db/eshop.php');

define('LIMIT', 5);

function getProducts($page = 0, $limit = LIMIT)
{
  $db = new ProductsDB();
  return $db->find($page, $limit);
}

$page = isset($_GET['page']) ? $_GET['page'] - 1 : 0;

$products = getProducts($page);

function getPages($limit = LIMIT)
{
  $db = new ProductsDB();
  return $db->getPageCount($limit);
}
$pages = getPages();

?>

<div class="row">
  <?php foreach ($products as $product) {
  ?>
    <div class="col-lg-4 col-md-6 mb-4 mt-4">
      <div class="card h-100">
        <img class="card-img-top img-cover" src="<?php echo $product['img'] == null || $product['img'] == '' ? 'https://placehold.co/600x400' : $product['img']; ?>" alt="<?php echo $product['name'] ?>" />
        <div class="card-body">
          <h4 class="card-title">
            <?php echo $product['name']; ?>
          </h4>
          <h5><?php echo $product['price']; ?>&nbsp;Kč</h5>
          <a href="cart.php?action=add&id=<?php echo $product['good_id']; ?>" class="btn btn-primary">Add to cart</a>
          <?php
          if (isset($_SESSION['username'])) {
          ?>
            <a href="update.php?id=<?php echo $product['good_id']; ?>" class="btn btn-warning">Edit</a>
            <a href="delete.php?id=<?php echo $product['good_id']; ?>" class="btn btn-danger">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trash-2">
                <path d="M3 6h18" />
                <path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6" />
                <path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2" />
                <line x1="10" x2="10" y1="11" y2="17" />
                <line x1="14" x2="14" y1="11" y2="17" />
              </svg>
            </a>
          <?php
          }
          ?>
        </div>
      </div>
    </div>
  <?php
  } ?>
</div>

<nav aria-label="Page navigation example">
  <ul class="pagination">
    <?php
    for ($i = 1; $i <= $pages; $i++) {
    ?>
      <li class="page-item <?php echo $i == $page + 1 ? 'active' : ''; ?>">
        <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
      </li>
    <?php
    }
    ?>
  </ul>
</nav>