<?php require_once __DIR__ . '/managerRequired.php' ?>
<?php

if ($user['privilege'] < 2) {
    echo 'You are not allowed to access this action.';
    exit();
}
