<?php
require __DIR__ . DIRECTORY_SEPARATOR . 'utils.php';
$filePath = './users.db';
$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST' || !empty($_POST)) {

    $fullName = htmlspecialchars(trim($_POST['full-name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $password = htmlspecialchars(trim($_POST['password']));
    $password2 = htmlspecialchars(trim($_POST['password2']));

    if (empty($fullName)) {
        array_push($errors, 'Nevyplněné jméno.');
    } else if (strlen($fullName) < 3) {
        array_push($errors, 'Neplatné jméno. Musí mít alespoň 3 charaktery.');
    }

    if (empty($email)) {
        array_push($errors, 'Nevyplněný email.');
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        array_push($errors, 'Neplatný formát emailu.');
    }

    if ($password != $password2) {
        array_push($errors, 'Hesla nejsou stejná.');
    }

    if (checkUserExists($filePath, $email)) {
        array_push($errors, 'Uživatel s tímto emailem již existuje.');
    }

    if (empty($errors)) {
        registerNewUser($fullName, $email, $password, $filePath);
        //email
        header("Location: login.php?email=$email");
    }

}

