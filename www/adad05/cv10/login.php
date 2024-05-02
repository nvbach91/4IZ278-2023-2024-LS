<?php

include 'includes/head.php';
require 'classes/UsersDB.php';
$usersDB = new UsersDB();

if (!empty($_POST)) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $errors = [];

    $users = $usersDB->findByEmail($email);
    if (!count($users) == 1) {
        array_push($errors, "There is no user with this email!");
    } else {
        if (!password_verify($password, $users[0]['password'])) {
            array_push($errors, "Password incorrect!");
        }
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        array_push($errors, "Enter a valid email!");
    }

    if (strlen($password) < 8) {
        array_push($errors, "Password must have at least 8 characters!");
    }

    if (count($errors) == 0) {
        echo 'OK';
        setcookie("username", $email, time() + 60 * 60);
        header("Location: index.php");
    } else {
        foreach ($errors as $error) {
            echo $error . '<br>';
        }
    }
}

?>



<div class="container container-products-margin">
    <h2 class="container-ref-page">Login</h2>
    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <label>Email:</label><br>
        <input type="text" name="email" value="<?php echo (isset($email)) ? $email : '' ?>"><br>
        <label>Password:</label><br>
        <input type="text" name="password" value="<?php echo (isset($password)) ? $password : '' ?>"><br>
        <button class="btn btn-primary btn-new" type="submit">Login</button>
    </form>
    <div class="container-ref-page">
        <a>If you don't have an account, you can <a href="register.php">register here!</a></a>
    </div>
</div>



<?php include 'includes/footer.php'; ?>