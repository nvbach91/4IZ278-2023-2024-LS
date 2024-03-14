<?php
require __DIR__ . '/utils/utils.php';
define('TITLE', 'Registration');

if (!empty($_POST)) {
    $name = cleanInput($_POST['name']);
    $email = cleanInput($_POST['email']);
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm_password'];

    if (empty($name) || empty($email) || empty($password) || empty($confirmPassword)) {
        $message = "Všechna pole musí být vyplněna.";
    } elseif (!validateEmail($email)) {
        $message = "Neplatný email.";
    } elseif ($password !== $confirmPassword) {
        $message = "Hesla se neshodují.";
    } else {
        $message = registerNewUser($name, $email, $password);
    }
}

?>
<?php include 'components/header.php'; ?>
<div class="center">
    <a class="nostyle" href="index.php">🏠</a>
    <h1>Registrace</h1>
<?php if (isset($message)) : ?>
    <p><?php echo $message; ?></p>
<?php endif; ?>
</div>
<div class="center">
    <form class="center" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        Jméno: <input type="text" name="name"><br>
        Email: <input type="email" name="email"><br>
        Heslo: <input type="password" name="password"><br>
        Potvrdit heslo: <input type="password" name="confirm_password"><br>
        <input type="submit" name="register" value="Registrovat">
    </form>
</div>
<?php include 'components/footer.php'; ?>