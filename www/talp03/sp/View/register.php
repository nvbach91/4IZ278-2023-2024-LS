<?php

require '../Controller/registration.php';

?>

<?php include './includes/head.php'; ?>
<body>
    <?php require './includes/navbar.php'; ?>
    <?php if (!empty($errors)): ?>
        <div class="form-errors">
            <?php foreach($errors as $error): ?>
                <p class="form-error"><?php echo $error; ?></p>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" class="form">
        <div class="form-group">
            <label for="name">Enter name</label>
            <input type="text" class="form-control" name="name">
            <label for="email">Enter email</label>
            <input type="text" class="form-control" name="email">
            <label for="password">Enter password</label>
            <input type="password" class="form-control" name="password">
        </div>
        <button type="submit" class="register-button">Register</button>
    </form>
    <?php include './includes/footer.php'; ?>
</body>
</html>