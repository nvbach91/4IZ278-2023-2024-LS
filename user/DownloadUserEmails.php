<?php
session_start();
require __DIR__ . '/../db/UsersDB.php';
?>
<?php
$usersDB = new usersDB();
$usersEmails = [];
$usersEmails = $usersDB->getUserEmails();

echo json_encode($usersEmails);
?>