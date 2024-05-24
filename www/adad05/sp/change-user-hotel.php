<?php

require __DIR__ . '/classes/UsersDB.php';
$usersDB = new UsersDB();

if(isset($_POST)){
    $usersDB->updateUserHotel($_POST['user_id'], $_POST['hotel_id']);
    Header ('Location: administration-page.php?edit-mode=users');
}

?>