<?php

require_once '../Model/UserDB.php';
$userDB = new UserDB();

$users = $userDB->findAll();

if (!empty($_POST)) {
    $privilege = htmlspecialchars(trim($_POST['privilege']));

    $userDB->changePrivilege($_POST['user_id'], $privilege);
}

?>