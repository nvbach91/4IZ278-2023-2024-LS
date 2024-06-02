<?php

require_once '../Model/UserDB.php';

$userDB = new UserDB();

if (!empty($_POST)) {

    $existingUser = $userDB->find('users', 'email', $_POST['email']);
    $user = $existingUser[0];
    
    if (password_verify($_POST['password'], $user['password'])) {
        setcookie('email', $_POST['email'], time() + 5600, '/cv01/sp/');
        session_start();
        header('Location: index.php');
        exit();
    } else {
        header('Location: login.php');
        exit('Invalid login');
    }
}

?>