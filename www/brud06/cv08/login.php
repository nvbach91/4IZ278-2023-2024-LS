<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];


    setcookie('name', $username, time() + 60 * 60, "/");
    header('Location: index.php');
    exit;
}
?>
<?php include 'includes/header.php'; ?>

<form method="post" action="login.php">
    Username: <input type="text" name="username"><br>
    Password: <input type="password" name="password"><br>
    <input type="submit" value="Log in">
</form>
<?php include 'includes/footer.php'; ?>