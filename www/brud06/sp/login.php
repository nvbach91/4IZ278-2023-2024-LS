<?php
session_start();

$message = '';
$messageForUser = '';
$authResult = null;
require_once 'db/UsersDB.php';
$userDB = new UsersDB();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    // Add your validations here
    $user = $userDB->findUser($email);

    if ($user === null) {
        $messageForUser = "User does not exist!";
    } elseif (password_verify($password, $user['password'])) {
        $messageForUser = "You have been successfully logged in!";
        $_SESSION['name'] = $email;
        $_SESSION['privilege'] = $user['privilege'];
        $_SESSION['user_id'] = $user['user_id'];
        setcookie('name', $email, time() + (86400 * 30), "/");
        header('Location: character_selection.php');
        exit;
    } else {
        $messageForUser = "Incorrect password!";
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
    </form>
</main>
<?php include 'includes/foot.php'; ?>