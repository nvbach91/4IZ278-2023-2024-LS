<?php

require_once '../Model/UserDB.php';

if (!isset($_COOKIE['email'])) {
    header('Location: ../View/index.php');
    exit('Unauthorized access!');
}

$userDB = new UserDB();
$privilege = $userDB->getPrivilege($_COOKIE['email']);

if ($privilege < 1) {
    header('Location: ../View/index.php');
    exit('Unauthorized access!');
}

?>