<?php

require_once 'db/Users.php';

$message = null;
$error = true;
$usersDb = new UsersDB();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    do {
        if(empty($_POST['username']) || empty($_POST['password'])) {
            $message = 'Please fill in both fields';
            break;
        }

        $username = $_POST['username'];
        $password = $_POST['password'];

        $registeredUser = $usersDb->getUser($username, $username);

        if($registeredUser == null){
            $message = 'No user was found under this username or email';
            break;
        }

        if(!password_verify($password, $registeredUser['passwordHash'])){
            $message = 'Wrong password';
            break;
        }

        setcookie('display_name', $registeredUser['username'], time() + 3600, "/");

        if($registeredUser['photo_url'] != null){
            setcookie('photo_url', $registeredUser['photo_url'], time() + 3600, "/");
        }

        $error = false;
        $message = 'Logged successfuly as ' . $registeredUser['username'];
        header('Location: index.php');
    
    } while(0);
}
?>
<?php include __DIR__ . '/components/header.php' ?>
<form method="post" action="login.php" class="form">
    <?php if($message != null){
            echo $error == true ? '<div class="error">'.$message.'</div>' : '<div class="correct">'.$message.'</div>';
        }
    ?>
    <div class="form-container">
    Username (email): <input type="text" name="username"><br>
    Password: <input type="password" name="password"><br>
    <a href="reset-password.php">Forgot password</a>
    <input type="submit" value="Log in">
    </div>

    <a href="google-oauth.php" class="google-login-btn">
    <span class="icon">
        <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 488 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M488 261.8C488 403.3 391.1 504 248 504 110.8 504 0 393.2 0 256S110.8 8 248 8c66.8 0 123 24.5 166.3 64.9l-67.5 64.9C258.5 52.6 94.3 116.6 94.3 256c0 86.5 69.1 156.6 153.7 156.6 98.2 0 135-70.4 140.8-106.9H248v-85.3h236.1c2.3 12.7 3.9 24.9 3.9 41.4z"/></svg>
    </span>
    Login with Google
</a>
</form>

<?php include __DIR__ . '/components/footer.php' ?>