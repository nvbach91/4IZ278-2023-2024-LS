<?php

require_once '../Model/UserDB.php';
$userDB = new UserDB();

$users = $userDB->findAll();

if (!empty($_POST)) {
    $userDB->changePrivilege($_POST);
}

?>