<?php
session_start();
if (isset($_POST["submit"])) {
    require_once __DIR__ . '../../config.php';
    function checkPassword($password)
    {
        $reg = "/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*\-.]).{8,}$/";

        if (preg_match($reg, $password)) {
            return true;
        } else {
            return false;
        }
    }

    $password = htmlspecialchars($_POST["password"]);
    $check = checkPassword($password);

    if ($check === false) {
        $_SESSION['form-email'] = trim(htmlspecialchars($_POST["email"]));
        $_SESSION['form-name'] = trim(htmlspecialchars($_POST["name"]));
        header("Location: index.php?signup=5");
        exit();
    }

    require_once BASE_PATH . '/includes/incl.php';


    $name = trim(htmlspecialchars($_POST["name"]));
    $email = trim(htmlspecialchars($_POST["email"]));
    $passwordHash = password_hash($password, PASSWORD_DEFAULT);
    $userCheck = $user->getUser($email);

    if (empty($userCheck) && !empty($name) && !empty($passwordHash) && !empty($email)) {
        $user_id = $user->addUser($email, $name, $passwordHash);
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
