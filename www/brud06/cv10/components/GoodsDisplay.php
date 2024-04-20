<?php
require_once 'db/GoodsDB.php';
$goodsDB = new GoodsDB();

$itemsPerPage = 4;
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$offset = ($page - 1) * $itemsPerPage;

$products = $goodsDB->findAll($itemsPerPage, $offset);
?>
<div class = "createItem"><a href="create-item.php">Create new item</a></div>

<div class="row">
  <?php foreach($products as $product): ?>
  <div class="col-lg-4 col-md-6 mb-4">
    <div class="card h-100">
      <a href="#!"><img class="card-img-top" src="<?php echo $product['img']; ?>" alt="..."></a>
      <div class="card-body">
        <h4 class="card-title"><a href="#!"><?php echo $product['name']; ?></a></h4>
        <h5><?php echo number_format($product['price'], 2) . ' ' . '€'; ?></h5>
        <p class="card-text"><?php echo $product['description']; ?></p>
      </div>
      <div class="card-footer">
        <div class="btn-group">
          <a href="buy.php?good_id=<?php echo $product['good_id']; ?>" class="btn">Buy</a>
          <a href="edit-item.php?good_id=<?php echo $product['good_id']; ?>" class="btn">Edit</a>
          <a href="delete-item.php?good_id=<?php echo $product['good_id']; ?>" class="btn">Delete</a>
        </div>
      </div>
    </div>
  </div>
  <?php endforeach; ?>
</div>

<nav aria-label="Page navigation example">
  <ul class="pagination">
    <?php for ($i = 1; $i <= ceil($goodsDB->getTotalCount() / $itemsPerPage); $i++): ?>
    <li class="page-item <?php echo $i == $page ? 'active' : ''; ?>"><a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
    <?php endfor; ?>
  </ul>
</nav>