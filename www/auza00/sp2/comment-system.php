<?php
session_start();
require 'db.php';

$user_id = $_SESSION['user_id'];

$stmt = $db->prepare('SELECT * FROM comments');
$stmt->execute();
$comments = $stmt->fetchAll();

$allComments = []; //all comments
foreach ($comments as $comment) {
    $nextComment = array($comment);
    array_push($allComments, $nextComment);
}
echo json_encode($allComments);
?>