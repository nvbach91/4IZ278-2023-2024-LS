<?php

require_once '../Model/UserDB.php';

$userDB = new UserDB();

if (!empty($_POST)) {
    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $password = htmlspecialchars(trim($_POST['password']));

    $errors = [];

    if (strlen($name) < 3) {
        array_push($errors, "Name must have 3 or more characters!");
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        array_push($errors, "Email is not valid!");
    }
    if (strlen($password) < '8') {
        array_push($errors, "Password must at least 8 characters long!");
    }
    elseif(!preg_match("#[0-9]+#",$password)) {
        array_push($errors, "Password mush contain at least 1 number!");
    }
    elseif(!preg_match("#[A-Z]+#",$password)) {
        array_push($errors, "Password mush contain at least 1 capital letter!");
    }
    elseif(!preg_match("#[a-z]+#",$password)) {
        array_push($errors, "Password mush contain at least 1 lowercase letter!");
    }

    if (count($errors) == 0) {
        $sucessMessage = 'Thank you for registration.';

        $_POST['password'] = password_hash($password, PASSWORD_DEFAULT);
        $userDB->registerUser($_POST);

        mail(
            'patrik.talkner@seznam.cz',
            'registration successful',
            '<h1>Thank you <h1>',
        );
        
        header('Location: login.php');
        exit();
    }
}

?>