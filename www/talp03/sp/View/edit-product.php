<?php

require_once '../Controller/entryPrivilege.php';
require '../Controller/editProductPage.php';

?>

<?php include './includes/head.php'; ?>
<body>
    <?php require './includes/navbar.php'; ?>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" class="form">
        <div class="form-group">
            <input type="hidden" class="form-control" name="product_id" value="<?php echo $product['product_id']; ?>" readonly>
            <label for="name">Name</label>
            <input type="name" class="form-control" name="name" value="<?php echo $product['name']; ?>">
            <label for="description">Description</label>
            <input type="text" class="form-control" name="description" value="<?php echo $product['description']; ?>">
            <label for="price">Price</label>
            <input type="number" class="form-control" name="price" value="<?php echo $product['price']; ?>">
            <label for="img">Picture of product</label>
            <input type="url" class="form-control" name="img" value="<?php echo $product['img']; ?>">
            <label for="category">Category</label>
            <select name="category_id" class="form-control">
                <?php foreach ($categories as $category) { ?>
                    <option value="<?php echo $category['category_id']; ?>"><?php echo $category['category_id']; ?> <?php echo $category['name']; ?></option>
                <?php } ?>
            </select>
            <input type="hidden" class="form-control" name="last_updated" value="<?php echo $product['last_updated']; ?>" readonly>
        </div>
        <button type="submit" class="edit-button">Save changes</button>
    </form>
    <?php include './includes/footer.php'; ?>
</body>
</html>