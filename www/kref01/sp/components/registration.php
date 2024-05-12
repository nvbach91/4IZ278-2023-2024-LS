<?php include './includes/head.php'; ?>

<!-- TODO php logic -->

<form class="form-signup" method="POST" action="<?php echo $_SERVER['PHP_SELF'] ?>">
    <div class="headline">Form validation example</div>
    <div class="headline">Registration form</div>
    <?php if (! empty($errors)): ?>
        <div class="form-errors">
            <?php foreach($errors as $error): ?>
                <p><?php echo $error;?></p>
            <?php endforeach;?>
        </div>
    <?php endif;?>
    <div class="form-group">
        <label>Name</label>
        <input class="form-control" name="name" placeholder="e.g. Homer Simpson" value="<?php echo isset($name) ? $name : '' ?>">
    </div>
    <div class="form-group">
        <label>Email</label>
        <input class="form-control" name="email" placeholder="e.g. example@gmail.com" value="<?php echo isset($email) ? $email : '' ?>">
    </div>
    <div class="form-group">
        <label>Password</label>
        <input class="form-control" type="password" name="password" value="">
    </div>
    <div class="form-group">
        <label>Repeat Password</label>
        <input class="form-control" type="password" name="confirmPassword" value="">
    </div>
    <button class="btn btn-primary" type="submit">
        <p>Submit</p>
    </button>
</form>

<?php include './includes/foot.php'; ?>
