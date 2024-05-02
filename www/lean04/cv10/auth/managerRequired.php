<?php require_once __DIR__ . '/registeredUserRequired.php' ?>
<?php
require __DIR__ . "/../database/UsersDB.php";

if (isset($_COOKIE['user_id'])) {
    $usersDB = new UsersDB();
    $user = $usersDB->find(['user_id' => $_COOKIE['user_id']]);
}

if ($user['privilege'] < 1) {
    echo 'You are not allowed to access this action.';
    exit();
}
