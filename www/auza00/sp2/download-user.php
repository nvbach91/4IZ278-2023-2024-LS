<?php
require 'db.php';

$stmt = $db->prepare('SELECT email FROM users');
$stmt->execute();
$users = $stmt->fetchAll();
$usersEmails = [];
foreach ($users as $user) {
    array_push($usersEmails, $user['email']);
}
echo json_encode($usersEmails);
?>