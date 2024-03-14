<?php
require __DIR__ . DIRECTORY_SEPARATOR . 'utils.php';
$filePath = './users.db';
$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST' || !empty($_POST)) {
    $email = htmlspecialchars(trim($_POST['email']));
    $password = htmlspecialchars(trim($_POST['password']));


    if (empty($email)) {
        array_push($errors, 'Nevyplněný email.');
    } else if (empty($password)) {
        array_push($errors, 'Nevyplněné heslo.');
    } else {
        $authResponse = authenticate($filePath, $email, $password);
        if (empty($authResponse)) {
            $auth = true;
        } else {
            array_push($errors, $authResponse);
        }
    }


}

