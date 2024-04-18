<?php 

require_once './classes/ProductDB.php';
$productsDB = new ProductDB();



$itemId = $_GET['good_id'];
$product = $productsDB->select($itemId);
$product = $product[0];

if (!empty($_POST)) {
    $productsDB->update($_POST, $itemId);
    header('Location: index.php');
    exit();
}

?>

<?php include './include/header.php'; ?>
    <?php require './include/navbar.php'; ?>
        <!-- Page Content-->
        <div class="container">
            <h1>Update item</h1>
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                <div class="form-group">
                    <label for="name">Product name</label>
                    <input type="text" class="form control" name="name" placeholder="<?php echo $product['name']; ?>">
                    <label for="price">Price</label>
                    <input type="text" class="form control" name="price" placeholder="<?php echo $product['price']; ?>">
                    <label for="description">Description</label>
                    <input type="text" class="form control" name="description" placeholder="<?php echo $product['description']; ?>">
                    <label for="img">Image URL</label>
                    <input type="text" class="form control" name="img" placeholder="<?php echo $product['img']; ?>">
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
        <?php include './include/footer.php'; ?>