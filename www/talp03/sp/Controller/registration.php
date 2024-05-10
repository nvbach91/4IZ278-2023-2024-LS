<?php

require_once '../Model/UserDB.php';

$userDB = new UserDB();

if (!empty($_POST)) {
    $_POST['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $userDB->registerUser($_POST);
    header('Location: index.php');
    exit();
}

// $userDB = new UserDB();
// $users = $userDB->find(1);

?>