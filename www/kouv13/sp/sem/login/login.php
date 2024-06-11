<?php
session_start();
if (isset($_SESSION['iduser'])) {
    header("Location: ../u/");
    exit();
}

if (isset($_POST["submit"])) {
    require_once __DIR__ . '../../config.php';
    require_once BASE_PATH . '/db/db.class.php';
    $db = new db();

    $email = trim(htmlspecialchars($_POST["email"]));
    $password = htmlspecialchars($_POST["password"]);

    if (!empty($password) && !empty($email)) {
        $passwordHash = $db->getPasswordHash($email);
        if (password_verify($password, $passwordHash->password)) {
            $_SESSION["email"] = $email;
            $user = $db->getUser($email);
            $_SESSION["name"] = $user->name;
            $_SESSION["iduser"] = $user->user_id;
            if ($user->user_id == "1") {
                $_SESSION["admin"] = true;
            }
            header("Location: ../u?login=1");
            exit();
        } else {
            header("Location: index.php?login=2");
            exit();
        }
    } else {
        header("Location: index.php?login=3");
        exit();
    }
} else {
    header("Location: index.php?login=4");
    exit();
}
