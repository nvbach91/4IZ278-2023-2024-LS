<?php

include 'includes/head.php';
require 'classes/UsersDB.php';
$usersDB = new UsersDB();

if (!empty($_POST)) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $errors = [];
    $success = false;

    $users = $usersDB->findByEmail($email);
    if (!count($users) == 0) {
        array_push($errors, "This email is already registered!");
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        array_push($errors, "Enter a valid email!");
    }

    if (strlen($password) < 8) {
        array_push($errors, "Password must have at least 8 characters!");
    }

    if (count($errors) == 0) {
        $success = true;
        $usersDB->createUser($email, password_hash($password, PASSWORD_DEFAULT));
        header("Location: login.php");
    } else {
        foreach ($errors as $error) {
            echo $error . '<br>';
        }
    }
}



?>

<div class="container container-products-margin">
    <h2 class="container-ref-page">Register</h2>
    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <label>Email:</label><br>
        <input name="email" value="<?php echo (isset($email) && !$success) ? $email : '' ?>"><br>
        <label>Password:</label><br>
        <input name="password" value="<?php echo (isset($password) && !$success) ? $password : '' ?>"><br>
        <button class="btn btn-primary btn-new" type="submit">Register</button>
    </form>
</div>

<?php include 'includes/footer.php'; ?>