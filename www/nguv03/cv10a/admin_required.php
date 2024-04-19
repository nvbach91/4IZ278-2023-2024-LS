<?php require_once __DIR__ . '/db.php' ?>
<?php

$user = findUser($pdo, 'consolidation@abc.def');
// var_dump($user);
if ($user['privilege'] < 3) {
    echo 'Admin privilege is required';
    exit();
}




if ($user['privilege'] < 1) {
    // navstevnik
}
if ($user['privilege'] > 0) {
    // manazer
    // admin
    // superadmin
}
if ($user['privilege'] > 1) {
    // admin
    // superadmin
}
if ($user['privilege'] > 2) {
    // superadmin
}
?>