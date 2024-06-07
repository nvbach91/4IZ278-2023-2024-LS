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

        if (!isset($_GET['token'])) {
            $message = 'Token not set. Please use the link from the email';
            $error = true;
            break;
        }

        $token = $_GET['token'];
        $tokenData = $tokensDb->getToken($token);

        if ($tokenData == null) {
            $message = 'Invalid token. Please use the link from the email';
            $error = true;
            break;
        }

        if (time() > $tokenData['expires_at']) {
            $message = 'Token has expired! Please renew it.';
            $error = true;
            break;
        }

        $_SESSION['reset_email'] = $tokenData['email'];
    } while (0);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    do {

        $password = $_POST['password'];
        $retypePassword = $_POST['retype_password'];

        if (empty($password) || empty($retypePassword)) {
            $message = 'Please fill in both fields';
            $error = true;
            break;
        }

        if ($password !== $retypePassword) {
            $message = 'Passwords do not match';
            $error = true;
            break;
        }

        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        $usersDb->updatePassword($_SESSION['reset_email'], $passwordHash);
        $tokensDb->deleteToken('email = ?', [$_SESSION['reset_email']]);

        $message = 'Password updated successfully. You can now log in with your new password';

        session_destroy();
    } while (0);
}

?>
<?php include __DIR__ . '/components/header.php' ?>


<form method="post" action="new-password.php" class="form">
    <?php
    if ($message != null) {
        echo $error == true ? '<div class="error">' . $message . '</div>' : '<div class="correct">' . $message . '</div>';
    }
    ?>
    <div class="form-container">
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" class="form-control" id="password" name="password">
        </div>
        <div class="form-group">
            <label for="retype_password">Retype password:</label>
            <input type="password" class="form-control" id="retype_password" name="retype_password">
        </div>
        <button type="submit" class="btn btn-primary">Set new password</button>
    </div>
</form>
<?php include __DIR__ . '/components/footer.php' ?>