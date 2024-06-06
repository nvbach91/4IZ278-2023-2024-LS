<?php
session_start();
require 'db.php';

$user_id = null;
$username = null;

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $username = $_SESSION['user_username'];
}

$stmt = $db->prepare('SELECT * FROM likes');
$stmt->execute();
$likes = $stmt->fetchAll();

$likedSpots = []; //spots user has liked
foreach ($likes as $like) {
    if ($like['user_id'] == $user_id) {
        $nextLike = array($like['spot_id']);
        array_push($likedSpots, $nextLike);
    }
}

$allLikes = []; //all likes
foreach ($likes as $like) {
    $nextLike = array($like['spot_id']);
    array_push($allLikes, $nextLike);
}

$stmt = $db->prepare('SELECT * FROM comments');
$stmt->execute();
$comments = $stmt->fetchAll();

$allComments = []; //all comments
foreach ($comments as $comment) {
    $nextComment = array($comment);
    array_push($allComments, $nextComment);
}

echo json_encode([$likedSpots, $allLikes, $allComments, $user_id, $username]);
?>