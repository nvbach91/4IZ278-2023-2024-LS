<?php

if (isset($_POST["submit"])) {
    require_once __DIR__ . '../../config.php';
    require_once BASE_PATH . '/db/db.class.php';
    $db = new db();

    $name = trim(htmlspecialchars($_POST["name"]));
    $email = trim(htmlspecialchars($_POST["email"]));
    $password = htmlspecialchars($_POST["password"]);
    $passwordHash = password_hash($password, PASSWORD_DEFAULT);

    $userCheck = $db->getUser($email);

    if (empty($userCheck) && !empty($name) && !empty($passwordHash) && !empty($email)) {
        $user_id = $db->addUser($email, $name, $passwordHash);
        if (!empty($user_id)) {
            session_start();
            $_SESSION["name"] = $name;
            $_SESSION["email"] = $email;
            $_SESSION["iduser"] = $user_id;
            header("Location: ../u?signup=1");
            exit();
        } else {
            header("Location: index.php?signup=3");
            exit();
        }
    } else {
        header("Location: index.php?signup=2");
        exit();
    }
} else {
    header("Location: index.php?signup=4");
    exit();
}
