<?php

session_start();

require_once 'oauth_config.php';

$message = '';
$messageForUser = '';
$authResult = null;
require_once 'db/UsersDB.php';
$userDB = new UsersDB();



if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    $user = $userDB->findUser($email);

    if ($user === null) {
        $messageForUser = "User does not exist!";
    } elseif (password_verify($password, $user['password'])) {
        $messageForUser = "You have been successfully logged in!";
        $_SESSION['name'] = $email;
        $_SESSION['privilege'] = $user['privilege'];
        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['isBanned'] = $user['isBanned'];
        setcookie('name', $email, time() + (86400 * 30), "/");
        
         // Check user privilege and redirect accordingly
         if ($user['privilege'] == 2) {
            header('Location: ./admin/admin_interface.php');
        } else {
            header('Location: character_selection.php');
        }
        
        
    } else {
        $messageForUser = "Password is incorrect!";
    }
    unset($_GET['message']);
}
?>

<?php include './includes/head.php'; ?>
<main class="main">

    <?php
    if (isset($_GET['message'])) {
        $message = urldecode($_GET['message']); ?>
        <div class="alert alert-success">
            <h2><?php echo $message; ?></h2>
        </div>
    <?php } ?>

    <?php if (!empty($messageForUser)): ?>
        <div class="alert alert-info">
            <h3><?php echo $messageForUser; ?></h3>
        </div>
    <?php endif; ?>

    <h1>Login</h1>
    <form class="form-signup" method="POST">
        <div class="form-group">
            <label>Email*</label>
            <input class="form-control" type="email" name="email">
        </div>
        <div class="form-group">
            <label>Password*</label>
            <input class="form-control" type="password" name="password">
            <button class="btn btn-primary" type="submit">Login</button>
        </div>
        <a class = "github-login" href="https://github.com/login/oauth/authorize?client_id=<?php echo GITHUB_CLIENT_ID; ?>&redirect_uri=<?php echo urlencode(GITHUB_REDIRECT_URI); ?>&scope=user">Login with GitHub</a>
    </form>
</main>
<?php include 'includes/foot.php'; ?>