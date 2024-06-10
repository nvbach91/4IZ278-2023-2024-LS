<?php

require_once '../Model/UserDB.php';

$userDB = new UserDB();

if (isset($_COOKIE['email'])) {
    $privilege = $userDB->getPrivilege($_COOKIE['email'])[0];
}

?>