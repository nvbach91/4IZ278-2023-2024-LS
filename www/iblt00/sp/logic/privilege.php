<?php require __DIR__ . '/../db/UsersDB.php' ?>
<?php

$users = new UserDB;
$user = $users->findByEmail('mail.com'); //TODO dynamic load
if ($user['type'] < 1) {
    echo 'regular user'; //TODO set params
    exit();
} elseif ($user['type'] < 2) {
    echo 'privileged user'; //TODO set params
} elseif ($user['type'] < 3) {
    echo 'admin'; //TODO set params
} else return 5; //TODO throw exception

?>
