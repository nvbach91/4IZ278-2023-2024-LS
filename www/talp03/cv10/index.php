<?php
require_once './UserDB.php';

if (!isset($_COOKIE)) {
    $userDB = new UserDB();
    $currentUser = $userDB->findUser($_COOKIE['email']);
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
    <div class="link">
        <a href="./create-item.php">Create item</a>
        <a href="./remove-item.php">Remove item</a>
        <a href="./update-item.php">Update item</a>
        <a href="./user-privileges.php">Change privilege</a>
    </div>
    <div class="login">
        <a href="./login.php">Login</a>
        <a href="./register.php">Register</a>
        <a href="./logout.php">Logout</a>
    </div>
</body>
</html>