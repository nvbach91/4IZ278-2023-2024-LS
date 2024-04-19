<?php
include "./classes/Products.php";

$products = new ProductsDB();

if (!empty($_POST)) {
  $products->create($_POST);
  header("Location: index.php");
  exit();
}
?>
<?php require __DIR__ . '/incl/header.php'; ?>
<?php require __DIR__ . '/incl/navbar.php'; ?>
<main class="container">
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
  <div class="form-group">
    <label >Product name
        <input name="name" class="form-control" placeholder="Enter product name">
    </label>
  </div>
  <br>
  <div class="form-group">
    <label >Description
        <input name="description" class="form-control" placeholder="Enter product description">
    </label>
  </div>
  <br>
  <div class="form-group">
    <label >Image url
        <input name="img" class="form-control" placeholder="Enter product image url">
    </label>
  </div>
  <br>
  <div class="form-group">
    <label >Price
        <input name="price" type="number" class="form-control" placeholder="Enter product price">
    </label>
  </div>
  <br>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
</main>
<?php require __DIR__ . '/incl/footer.php'; ?>