<?php

require_once '../Model/UserDB.php';
$userDB = new UserDB();

$users = $userDB->findAll();
$errors = [];

if (!empty($_POST)) {
    $privilege = htmlspecialchars(trim($_POST['privilege']));
    if ($privilege > 1) {
        array_push($errors, 'Privilige can be 0 or 1.');
    }
    if (!is_int($privilege)) {
        array_push($errors, 'Privilige must be a number!');
    }
    
    if (empty($errors)) {
        $userDB->changePrivilege($_POST['user_id'], $privilege);
    }
}

?>