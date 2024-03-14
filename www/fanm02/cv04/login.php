<?php
require __DIR__ . '/utils/utils.php';
define('TITLE', 'Login');

if (!empty($_POST)) {
    $email = cleanInput($_POST['email']);
    $password = $_POST['password'];

    if (empty($email) || empty($password)) {
        $loginMessage = "Všechna pole musí být vyplněna.";
    } elseif (!validateEmail($email)) {
        $loginMessage = "Neplatný email.";
    } else {
        $loginMessage = loginUser($email, $password);
    }
}

?>
<?php include 'components/header.php'; ?>
<div class="center">
    <a class="nostyle" href="index.php">🏠</a>
    <h1>Přihlášení</h1>
<?php if (isset($loginMessage)) : ?>
    <p><?php echo $loginMessage; ?></p>
<?php endif; ?>
</div>
<div class="center">
    <form class="center" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        Email: <input type="text" name="email"><br>
        Heslo: <input type="password" name="password"><br>
        <input type="submit" name="login" value="Přihlásit">
    </form>
</div>
<?php include 'components/footer.php'; ?>