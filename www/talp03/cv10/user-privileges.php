<?php

require './admin-required.php';
require_once './UserDB.php';
$userDB = new UserDB();

$users = $userDB->findAll();

if (!empty($_POST)) {
    $userDB->changePrivilege($_POST['user_id'], $_POST['privilege']);
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
    <ul>
        <?php foreach($users as $user): ?>
            <li>
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                    <h5><?php echo $user['name']; ?></h5>
                    <label for="user_id">User id</label>
                    <input name="user_id" type="number" readonly value="<?php echo $user['user_id']; ?>">
                    <label for="email">Email</label>
                    <input name="email" type="text" readonly value="<?php echo $user['email']; ?>">
                    <label for="privilege">Privilege</label>
                    <input name="privilege" type="number" value="<?php echo $user['privilege']; ?>" min="0" max="3">
                    <button type="submit">Change privilege </button>
                </form>
            </li>
        <?php endforeach;?>
    </ul>
    <a href="index.php">Home</a>
</body>
</html>