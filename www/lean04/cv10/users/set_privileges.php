<?php

require __DIR__ . '/../database/UsersDB.php';

if (!empty($_POST)) {
    $user_id = htmlspecialchars(trim($_POST["user_id"]));
    $privilege = htmlspecialchars(trim($_POST["privilege"]));

    $usersDB = new UsersDB();
    $users = $usersDB->setPrivilege([
        'user_id' => $user_id,
        'privilege' => $privilege
    ]);

    header("Location: ../user-privileges.php");
}
