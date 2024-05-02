<form class="form-signup" method="POST" action="<?php echo isset($productId) ? $_SERVER["PHP_SELF"] . "?product_id=" . $productId : $_SERVER["PHP_SELF"]; ?>">
    <div>
        <?php if (isset($successMessage)) : ?>
            <h2 class="form-success"><?php echo $successMessage; ?></h2>
        <?php endif; ?>

        <?php if (!empty($errors)) : ?>
            <div class="form-errors">
                <?php foreach ($errors as $error) : ?>
                    <p class="form-error"><?php echo $error; ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>

    <div class="form-group">
        <label>Name*</label>
        <input class="form-control" name="name" value="<?php echo isset($name) ? $name : '' ?>">
    </div>
    </div>
    <div class="form-group">
        <label>Price*</label>
        <input class="form-control" name="price" value="<?php echo isset($price) ? $price : '' ?>">
    </div>
    <div class="form-group">
        <label>Description</label>
        <textarea rows="6" class="form-control" name="description"><?php echo isset($description) ? $description : '' ?></textarea>
    </div>
    <div class="form-group">
        <label>Image URL*</label>
        <input class="form-control" name="image" value="<?php echo isset($image) ? $image : '' ?>">
    </div>
    <?php if (isset($avatar)) : ?>
        <div class="form-group">
            <label>Avatar</label>
            <img src="<?php echo $avatar; ?>" alt="Avatar">
        </div>
    <?php endif; ?>
    <button class="btn btn-primary" type="submit">Submit</button>
</form>