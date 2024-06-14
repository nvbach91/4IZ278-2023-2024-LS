<?php
session_start();
if (isset($_SESSION['iduser'])) {
    header("Location: ../u/");
    exit();
}

if (isset($_POST["submit"])) {
    require_once __DIR__ . '../../config.php';
    require_once BASE_PATH . '/includes/incl.php';

    $email = trim(htmlspecialchars($_POST["email"]));
    $password = htmlspecialchars($_POST["password"]);

    if (!empty($password) && !empty($email)) {
        $passwordHash = $user->getPasswordHash($email);
        if (password_verify($password, $passwordHash->password)) {
            $_SESSION["email"] = $email;
            $u = $user->getUser($email);
            $_SESSION["name"] = $u->name;
            $_SESSION["iduser"] = $u->user_id;
            if ($u->user_id == "1") {
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
