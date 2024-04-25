<?php 

require_once './UserDB.php';

$userDB = new UserDB();
if (isset($_COOKIE['email'])) {
    $currentUser = $userDB->findUser($_COOKIE['email']);
}

if ($currentUser['privilege'] < 2) {
    header('Location: index.php');
    exit();
}

?>

