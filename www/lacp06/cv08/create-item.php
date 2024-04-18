<?php

require_once './db/database_eshop.php';

$productsDB = new ProductsDB();
$action = $_SERVER['PHP_SELF'];

if (!empty($_POST)) {
  $name = htmlspecialchars(trim($_POST['product_name']));
  $description = htmlspecialchars(trim($_POST['description']));
  $price = $_POST['price'];
  $image = htmlspecialchars(trim($_POST['image']));

  $errors = [];
  if (strlen($name) < 3) {
    empty($name) ? $name_check = "Name is required!" : $name_check = $name . " must have 3 or more characters!";
    array_push($errors, $name_check);
  }
  if (strlen($description) < 3) {
    empty($description) ? $description_check = "Description is required!" : $description_check = $description . " must have 3 or more characters!";
    array_push($errors, $description_check);
  }
  if (!is_numeric($price)) {
    empty($price) ? $price_check = "Price is required!" : $price_check = $price . " is not a valid price!";
    array_push($errors, $price_check);
  }
  if (empty($image) or $image === "") {
    $image = "https://upload.wikimedia.org/wikipedia/commons/thumb/1/1b/Svelte_Logo.svg/1200px-Svelte_Logo.svg.png";
  }

  if (count($errors) == 0) {
    $successMessage = "Product added!";
    $productsDB->createItem($name, $price, $description, $image);
  }
}
?>

<?php require __DIR__ . '/includes/Header.php'; ?>
<div class="container">
  <form action="<?php echo $action ?>" method="POST" style="display: flex; flex-direction: column; height: 600px; justify-content: center;">
    <?php if (!empty($errors)) : ?>
      <div class="alert alert-danger">
        <?php foreach ($errors as $error) : ?>
          <p><?php echo $error; ?></p>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>
    <?php if (isset($successMessage)) : ?>
      <div class="alert alert-success" role="alert">
        <p><?php echo $successMessage; ?></p>
      </div>
    <?php endif; ?>
    <input type="text" name="product_name" class="form-control" placeholder="*Product Name">
    <input type="number" name="price" class="form-control" placeholder="*Price">
    <input type="text" name="description" class="form-control" placeholder="*Description">
    <input type="text" name="image" class="form-control" placeholder="Image">
    <button type="submit" class="btn btn-primary">Create</button>
  </form>
</div>
<div style="position: absolute; bottom: 0; width: 100%;">
  <?php require __DIR__ . '/includes/Footer.php'; ?>
</div>