<?php
session_start();
$cart = $_SESSION['cart'];

include "./classes/Products.php";

$products = new ProductsDB();
$products = $products->readAll();

function test_cart($product) {
    $cart = $_SESSION['cart'];
    if (in_array($product['good_id'], $cart)) {
        return true;
    } else {
        return false;
    }
}

$products = array_filter($products,"test_cart");
?>

<?php require __DIR__ . '/incl/header.php'; ?>
<?php require __DIR__ . '/incl/navbar.php'; ?>
<main class="container">
    <h1>Cart</h1>
    <table class="table table-hover">
  <thead>
    <tr>
      <th scope="col">Name</th>
      <th scope="col">Description</th>
      <th scope="col">Price</th>
      <th scope="col"></th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($products as $product): ?>
    <tr>
      <th scope="row"><?= $product['name'] ?></th>
      <td><?= $product['description'] ?></td>
      <td><strong><?= $product['price'] ?></strong></td>
      <td><a href="./remove-item.php?good_id=<?= $product['good_id'] ?>"><button class="btn btn-danger">X</button></a></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>
</main>
<?php require __DIR__ . '/incl/footer.php'; ?>