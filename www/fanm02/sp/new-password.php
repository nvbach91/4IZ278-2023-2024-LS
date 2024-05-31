<?php
require_once 'db/Users.php';
require_once 'db/Tokens.php';

session_start();

$message = null;
$usersDb = new UsersDB();
$tokensDb = new TokensDB();
$error = false;

if ($_SERVER['REQUEST_METHOD'] === 'GET') {

    do {

        if(!isset($_GET['token'])){
            $message = 'Token not set. Please use the link from the email';
            $error = true;
            break;
        }

        $token = $_GET['token'];
        $tokenData = $tokensDb->getToken($token);

        if($tokenData == null){
            $message = 'Invalid token. Please use the link from the email';
            $error = true;
            break;
        }

        if(time() > $tokenData['expires_at']){
            $message = 'Token has expired! Please renew it.';
            $error = true;
            break;
        }

        $_SESSION['reset_email'] = $tokenData['email'];
    
    } while(0);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    do {

        $password = $_POST['password'];
        $retypePassword = $_POST['retype_password'];

        if(empty($password) || empty($retypePassword)){
            $message = 'Please fill in both fields';
            $error = true;
            break;
        }

        if($password !== $retypePassword){
            $message = 'Passwords do not match';
            $error = true;
            break;
        }

        $passwordHash = password_hash($password, PASSWORD_DEFAULT);
        
        $usersDb->updatePassword($_SESSION['reset_email'], $passwordHash);
        $tokensDb->delete('email = ?', [$_SESSION['reset_email']]);

        $message = 'Password updated successfully. You can now log in with your new password';

        session_destroy();

    } while(0);
}

?>
<?php include __DIR__ . '/components/header.php' ?>
<form method="post" action="new-password.php" class="form">
    <?php
        if($message != null){
            echo $error == true ? '<div class="error">'.$message.'</div>' : '<div class="correct">'.$message.'</div>';
        }
    ?>
    <div class="form-container">
        Password: <input type="password" name="password"><br>
        Retype password: <input type="password" name="retype_password"><br>
        <input type="submit" value="Set new password">
    </div>
</form>
<?php include __DIR__ . '/components/footer.php' ?>