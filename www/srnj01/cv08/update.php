<?php
require_once('db/eshop.php');

if (isset($_POST['id'])) {
  $db = new ProductsDB();
  $name = $_POST['name'];
  $price = $_POST['price'];
  $description = isset($_POST['description']) ? $_POST['description'] : '';
  $img = isset($_POST['img']) ? $_POST['img'] : '';
  $db->update($_POST['id'], $name, $price, $description, $img);
  header('Location: update.php?success=true&id=' . $_POST['id']);
}

if (isset($_GET['id'])) {
  $db = new ProductsDB();
  $product = $db->findById($_GET['id'])[0];
} else {
  header('Location: add.php');
}

include('includes/header.php');

?>

<div class="row">
  <div class="col-lg-12">
    <h1 class="my-4">Edit product</h1>
    <form method="POST">
      <input type="hidden" name="id" value="<?php echo $product['good_id']; ?>">
      <div class="form-group">
        <label for="name">Name</label>
        <input type="text" class="form-control" id="name" name="name" value="<?php echo $product['name']; ?>" required>
      </div>
      <div class="form-group">
        <label for="price">Price</label>
        <input type="number" class="form-control" id="price" name="price" value="<?php echo $product['price']; ?>" required>
      </div>
      <div class="form-group">
        <label for="description">Description</label>
        <textarea class="form-control" id="description" name="description"><?php echo $product['description']; ?></textarea>
      </div>
      <div class="form-group">
        <label for="img">Image URL</label>
        <input type="text" class="form-control" id="img" name="img" value="<?php echo $product['img']; ?>">
      </div>
      <button type="submit" class="btn btn-primary">Edit product</button>
    </form>
  </div>
</div>

<?php
include('includes/footer.php');
?>