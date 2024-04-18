<?php
require_once('db/eshop.php');

if (isset($_POST['name']) && isset($_POST['price'])) {
  $db = new ProductsDB();
  $name = $_POST['name'];
  $price = $_POST['price'];
  $description = isset($_POST['description']) ? $_POST['description'] : '';
  $img = isset($_POST['img']) ? $_POST['img'] : '';
  $db->add($name, $price, $description, $img);
  header('Location: add.php?success=true');
}

include('includes/header.php');

?>

<div class="row">
  <div class="col-lg-12">
    <h1 class="my-4">Add a new product</h1>
    <form method="POST">
      <div class="form-group">
        <label for="name">Name</label>
        <input type="text" class="form-control" id="name" name="name" required>
      </div>
      <div class="form-group
      ">
        <label for="price">Price</label>
        <input type="number" class="form-control" id="price" name="price" required>
      </div>
      <div class="form-group">
        <label for="description">Description</label>
        <textarea class="form-control" id="description" name="description"></textarea>
      </div>
      <div class="form-group">
        <label for="img">Image URL</label>
        <input type="text" class="form-control" id="img" name="img">
      </div>
      <button type="submit" class="btn btn-primary">Add product</button>
    </form>
  </div>
</div>

<?php
include('includes/footer.php');
