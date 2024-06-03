<?php

require '../Controller/loginController.php';

?>

<?php include './includes/head.php'; ?>
<body>
    <?php require './includes/navbar.php'; ?>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" class="form">
        <div class="form-group">
            <label for="email">Enter email</label>
            <input type="text" class="form-control" name="email">
            <label for="password">Enter password</label>
            <input type="password" class="form-control" name="password">
        </div>
        <button type="submit" class="register-button">Login</button>
    </form>
    <?php include './includes/footer.php'; ?>
</body>
</html>