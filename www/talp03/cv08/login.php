<?php

if (!empty($_POST['name'])) {
    setcookie('name', $_POST['name'], time() + 3600);
    header('Location: index.php');
    exit();
}

?>

<?php include './include/header.php'; ?>
    <?php require './include/navbar.php'; ?>
        <!-- Page Content-->
        <div class="container">
            <h1>Login</h1>
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form control" name="name" placeholder="Name">
                </div>
                <button type="submit" class="btn btn-primary">Login</button>
            </form>
        </div>
        <?php include './include/footer.php'; ?>