<?php
include "./classes/Products.php";

$products = new ProductsDB();

if (!empty($_GET["page"])) {
  $currPage = $_GET["page"];
} else {
  $currPage = 1;
}

$products_goods_per_page = 4;
$allProductsCount = $products->count();
$products = $products->getWithLimit($products_goods_per_page, ($currPage-1) * $products_goods_per_page);
$pagination_count = ceil($allProductsCount / $products_goods_per_page);


?>

<?php require __DIR__ . '/incl/header.php'; ?>
<?php require __DIR__ . '/incl/navbar.php'; ?>
<main class="container">
  <a href="./create-item.php">create new product</a>
  <nav aria-label="Page navigation example">
    <ul class="pagination">
      <li class="page-item">
        <a class="page-link" href="./?page=<?= $currPage - 1 ?>" aria-label="Previous">
          <span aria-hidden="true">&laquo;</span>
        </a>
      </li>

      <?php for ($i = 1; $i < $pagination_count; $i++): ?>
        <li class="page-item"><a class="page-link" href="./?page=<?= $i ?>">
            <?= $i ?>
          </a></li>
      <?php endfor; ?>

      <li class="page-item">
        <a class="page-link" href="./?page=<?= $currPage + 1 ?>" aria-label="Next">
          <span aria-hidden="true">&raquo;</span>
        </a>
      </li>
    </ul>
  </nav>
  <div class="products">
    <?php foreach ($products as $product): ?>
      <div class="card" style="width: 18rem;">
        <img class="card-img-top" src="<?= $product['img'] ?>" alt="Card image">
        <div class="card-body">
          <h5 class="card-title">
            <?= $product['name'] ?>
          </h5>
          <p class="card-text">
            <?= $product['description'] ?>
          </p>
          <h5 class="card-text">
            <?= $product['price'] ?>
          </h5>
          <a href="./buy.php?good_id=<?= $product['good_id'] ?>" class="btn btn-primary">Add to cart</a>
          <a href="./edit-item.php?good_id=<?= $product['good_id'] ?>" class="btn btn-warning">Edit</a>
          <a href="./delete-item.php?good_id=<?= $product['good_id'] ?>" class="btn btn-danger">Delete</a>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</main>
<?php require __DIR__ . '/incl/footer.php'; ?>