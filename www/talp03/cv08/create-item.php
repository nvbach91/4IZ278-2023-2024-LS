<?php 

require_once './classes/ProductDB.php';
$productsDB = new ProductDB();

if (!empty($_POST)) {
    $productsDB->create($_POST);
    header('Location: index.php');
    exit();
}

?>

<?php include './include/header.php'; ?>
    <?php require './include/navbar.php'; ?>
        <!-- Page Content-->
        <div class="container">
            <h1>Create new item</h1>
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                <div class="form-group">
                    <label for="name">Product name</label>
                    <input type="text" class="form control" name="name" placeholder="Name">
                    <label for="price">Price</label>
                    <input type="text" class="form control" name="price" placeholder="Price">
                    <label for="description">Description</label>
                    <input type="text" class="form control" name="description" placeholder="Description">
                    <label for="img">Image URL</label>
                    <input type="text" class="form control" name="img" placeholder="Img">
                </div>
                <button type="submit" class="btn btn-primary">Create</button>
            </form>
        </div>
        <?php include './include/footer.php'; ?>