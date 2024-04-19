<?php

require_once './db/database_eshop.php';

$productsDB = new ProductsDB();
$action = $_SERVER['PHP_SELF'];

if (isset($_GET['good_id'])) {
  $good_id = $_GET['good_id'];
  $product = $productsDB->findById($good_id);

  $d_name = $product[0]['name'];
  $d_price = $product[0]['price'];
  $d_description = $product[0]['description'];
  $d_image = $product[0]['img'];
} else {
  $d_name = "";
  $d_price = "";
  $d_description = "";
  $d_image = "";
}

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

  if (count($errors) == 0) {
    $successMessage = "Product edited!";
    $productsDB->createItem($name, $price, $description, $image);
  }
} else {
  $name = '';
  $price = '';
  $description = '';
  $image = '';
}
?>

<?php require __DIR__ . '/includes/Header.php'; ?>
<div class="container">
  <form action="<?php echo $action ?>" method="POST" style="display: flex; flex-direction: column; height: 600px; justify-content: center;">
    <?php if (isset($successMessage)) : ?>
      <div class="alert alert-success" role="alert">
        <p><?php echo $successMessage; ?></p>
      </div>
    <?php endif; ?>
    <input type="text" name="product_name" class="form-control" placeholder="<?php echo $d_name ?>" value="<?php echo $d_name ? $d_name : $name; ?>">
    <input type="number" name="price" class="form-control" placeholder="<?php echo $d_price ?>" value="<?php echo $d_price ? $d_price : $price; ?>">
    <input type="text" name="description" class="form-control" placeholder="<?php echo $d_description ?>" value="<?php echo $d_description ? $d_description : $description; ?>">
    <input type="text" name="image" class="form-control" placeholder="<?php echo $d_image ?>" value="<?php echo $d_image ? $d_image : $image; ?>">
    <button type="submit" class="btn btn-primary">Edit</button>
  </form>
</div>
<div style="position: absolute; bottom: 0; width: 100%;">
  <?php require __DIR__ . '/includes/Footer.php'; ?>
</div>