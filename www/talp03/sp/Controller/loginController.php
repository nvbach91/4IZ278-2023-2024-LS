<?php

require_once '../Model/UserDB.php';

$userDB = new UserDB();

if (!empty($_POST)) {
    $_POST['email'] = htmlspecialchars(trim($_POST['email']));
    $_POST['password'] = htmlspecialchars(trim($_POST['password']));

    $existingUser = $userDB->find('users', 'email', $_POST['email']);
    $user = $existingUser[0];
    
    if (password_verify($_POST['password'], $user['password'])) {
        setcookie('email', $_POST['email'], time() + 21600, '/cv01/sp/');
        session_start();
        header('Location: index.php');
        exit();
    } else {
        header('Location: login.php');
        exit('Invalid login');
    }
}

?>