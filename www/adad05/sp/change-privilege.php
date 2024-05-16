<?php

require __DIR__ . '/classes/UsersDB.php';
$usersDB = new UsersDB();

if(isset($_POST)){
    $usersDB->updateUser($_POST['user_id'], $_POST['privilege']);
    Header ('Location: administration-page.php');
}

?>