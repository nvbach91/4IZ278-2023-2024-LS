<?php
session_start();
require 'db.php';

$email = $_COOKIE["oAuthEmail"];

$stmt = $db->prepare('SELECT * FROM users WHERE email = :email LIMIT 1'); //limit 1 jen jako vykonnostni optimalizace, 2 stejne maily se v db nepotkaji
$stmt->execute([
    'email' => $email
]);
$user_id = @$stmt->fetchAll()[0];

$_SESSION['user_id'] = $user_id['user_id'];
$_SESSION['user_username'] = $user_id['username'];
$_SESSION['user_email'] = $email;

?>