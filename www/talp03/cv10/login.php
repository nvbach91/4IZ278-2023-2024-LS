<?php
session_start();
require_once './UserDB.php';
$userDB = new UserDB();

if (!empty($_POST)) {

    $existingUser = $userDB -> findUser($_POST['email']);

    if (password_verify($_POST['password'], $existingUser['password'])) {
        setcookie('email', $existingUser['email'], time() + 3600);
        header('Location: index.php');
        exit();
    } else {
        header('HTTP/1.1 401 Unauthorized');
        exit('Invalid login');
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
        <div class="form-group">
            <label for="email">Enter email</label>
            <input type="email" class="form-control" name="email">
            <label for="password">Enter password</label>
            <input type="password" class="form-control" name="password">
        </div>
        <button type="submit" class="button">Login</button>
    </form>
    <a href="index.php">Home</a>
</body>
</html>