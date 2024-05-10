<?php

require_once '../Model/UserDB.php';

$userDB = new UserDB();
$users = $userDB->findAll();

?>