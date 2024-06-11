<?php
session_start();
require_once __DIR__ . '../../../config.php';
include BASE_PATH . '/includes/auth.php';
require_once BASE_PATH . '/db/db.class.php';
$db = new db();
$email = $_SESSION['email'];
$oldPassword = htmlspecialchars($_POST["old-password"]);
$newPassword = htmlspecialchars($_POST["new-password"]);
$againPassword = htmlspecialchars($_POST["again-password"]);
if (!empty($oldPassword) && !empty($newPassword) && $newPassword === $againPassword && $newPassword != $oldPassword) {
    $passwordHash = $db->getPasswordHash($email);
    if (password_verify($oldPassword, $passwordHash->password)) {
        $newPasswordHash = password_hash($newPassword, PASSWORD_DEFAULT);
        if ($db->changePassword($newPasswordHash, $_SESSION['iduser'])) {
            header("Location: /~kouv13/sem/u/profile?chng=1");
            exit();
        } else {
            //nejde zmenit
            header("Location: /~kouv13/sem/u/profile?chng=3");
            exit();
        }
    } else {
        //stary heslo neni spravne
        header("Location: /~kouv13/sem/u/profile?chng=2");
        exit();
    }
} else {
    //nesplnuje podminky nahore
    header("Location: /~kouv13/sem/u/profile?chng=4");
    exit();
}
