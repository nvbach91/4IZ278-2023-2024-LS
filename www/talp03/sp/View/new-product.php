<?php

require_once '../Controller/entryPrivilege.php';
require '../Controller/createProduct.php';

?>

<?php include './includes/head.php'; ?>
<body>
    <?php require './includes/navbar.php'; ?>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" class="form">
        <div class="form-group">
            <label for="name">Name</label>
            <input type="name" class="form-control" name="name">        
            <label for="description">Description</label>
            <input type="text" class="form-control" name="description">
            <label for="price">Price</label>
            <input type="number" class="form-control" name="price">         
            <label for="img">Picture of product</label>
            <input type="url" class="form-control" name="img">       
            <label for="category">Category</label>
            <select name="category_id" class="form-control">
                <?php foreach ($categories as $category) { ?>
                    <option value="<?php echo $category['category_id']; ?>"><?php echo $category['category_id']; ?> <?php echo $category['name']; ?></option>
                <?php } ?>
            </select>
        </div>
        <button type="submit" class="edit-button">Create product</button>
    </form>
    <?php include './includes/footer.php'; ?>
</body>
</html>