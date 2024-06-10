<?php

require '../Controller/loginController.php';
require '../Controller/oauthController.php';

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
    <div class="user-container">
        <a href="https://github.com/login/oauth/authorize?client_id=<?php echo $_ENV['CLIENT_ID']; ?>&scope=user">Login with Github</a>
    </div>
    <?php include './includes/footer.php'; ?>
</body>
</html>