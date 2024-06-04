<?php

require_once 'db/Users.php';

$message = null;
$error = true;
$usersDb = new UsersDB();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    do {
        if(empty($_POST['username']) || empty($_POST['password']) || empty($_POST['email']) || empty($_POST['retypepassword'])) {
            $message = 'Please fill in all fields';
            break;
        }

        $username = htmlspecialchars($_POST['username']);
        $password = htmlspecialchars($_POST['password']);
        $email = htmlspecialchars($_POST['email']);
        $retypepassword = htmlspecialchars($_POST['retypepassword']);

        if (strlen(($username)) < 3) {
            $message = 'Username is too short';
            break;
        }

        if (strlen(($password)) < 3) {
            $message = 'Password is too short';
            break;
        }

        if ($password !== $retypepassword) {
            $message = 'Passwords do not match';
            break;
        }

        $existedUser = $usersDb->getUser($username, '');

        if ($existedUser != null){
            $message = 'Username already taken';
            break;
        }

        $existedUser = $usersDb->getUser('', $email);

        if ($existedUser != null){
            $message = 'Email already used';
            break;
        }

        $passwordHash = password_hash($password, PASSWORD_DEFAULT);
        $usersDb->create([$username, $email, $passwordHash]);

        setcookie('display_name', $username, time() + 3600, "/");
        $error = false;
        $message = 'Registration successful';
        header('Location: index.php');

    } while(0);

}
?>
<?php include __DIR__ . '/components/header.php' ?>


<form method="post" action="register.php" class="form">
    <?php if($message != null){
            echo $error == true ? '<div class="error">'.$message.'</div>' : '<div class="correct">'.$message.'</div>';
        }
    ?>
    <div class="form-container">
        <div class="form-group">
            <label for="username">Username:</label>
            <input type="text" class="form-control" id="username" name="username">
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" id="email" name="email">
        </div>
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" class="form-control" id="password" name="password">
        </div>
        <div class="form-group">
            <label for="retypepassword">Retype Password:</label>
            <input type="password" class="form-control" id="retypepassword" name="retypepassword">
        </div>
        <button type="submit" class="btn btn-primary">Register</button>
        <div class="space"></div>
    <a href="google-oauth.php" class="google-login-btn btn btn-outline-primary">
        <span class="icon">
            <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 488 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                <path d="M488 261.8C488 403.3 391.1 504 248 504 110.8 504 0 393.2 0 256S110.8 8 248 8c66.8 0 123 24.5 166.3 64.9l-67.5 64.9C258.5 52.6 94.3 116.6 94.3 256c0 86.5 69.1 156.6 153.7 156.6 98.2 0 135-70.4 140.8-106.9H248v-85.3h236.1c2.3 12.7 3.9 24.9 3.9 41.4z" />
            </svg>
        </span>
        Sign in with Google
    </a>
    </div>
</form>
<?php include __DIR__ . '/components/footer.php' ?>