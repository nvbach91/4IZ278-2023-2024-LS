<?php
require __DIR__ . DIRECTORY_SEPARATOR . 'utils' . DIRECTORY_SEPARATOR . 'utils.php';

$email = $_GET['email'] ?? '';
$message = '';
$messageForUser = '';
$authResult = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    // Add your validations here
    $authResult = authenticate('./users.db', $email, $password);

    if ($authResult === "User does not exist") {
        $messageForUser = "User does not exist!";
    } elseif ($authResult === true) {
        $messageForUser = "You have been successfully logged in!";
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
    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if ($authResult === true) : ?>
            <div class="alert alert-success">
                <h2><?php echo $messageForUser; ?></h2>
            </div>
        <?php else : ?>
            <div class="alert alert-danger">
                <h2><?php echo $messageForUser; ?></h2>
            </div>
        <?php endif; ?>
    <?php } ?>
    <h1>Login</h1>
    <form class="form-signup" method="POST">
        <div class="form-group">
            <label>Email*</label>
            <input class="form-control" type="email" name="email" value="<?php echo $email; ?>">
        </div>
        <div class="form-group">
            <label>Password*</label>
            <input class="form-control" type="password" name="password">
            <button class="btn btn-primary" type="submit">Login</button>
        </div>
    </form>
</main>
</body>

</html>