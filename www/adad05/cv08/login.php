<?php

include 'includes/head.php';

if (!empty($_POST)) {
    var_dump($_POST);
    setcookie("username", $_POST['username'], time() + 60 * 60);
    header("Location: index.php");
}

?>



<div class="container container-products-margin">
    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <label>Username:</label><br>
        <input type="text" name="username"><br>
        <button class="btn btn-primary btn-new" type="submit">Submit</button>
    </form>
</div>



<?php include 'includes/footer.php'; ?>