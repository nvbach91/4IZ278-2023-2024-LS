<?php
session_start();
require 'db.php';
?>
<?php

$user_id = $_SESSION['user_id'];
$like_spot_id = $_GET['like_spot_id'];
$date = date('Y-m-d H:i:s');

$stmt = $db->prepare('SELECT * FROM likes');
$stmt->execute();
$likes = $stmt->fetchAll();

$alreadyLiked = false;

foreach ($likes as $like) {
    if ($like['spot_id'] == $like_spot_id && $like['user_id'] == $user_id) {
        $alreadyLiked = true;
        break;
    }
}

if ($alreadyLiked == false) {
    $stmt = $db->prepare("INSERT INTO likes(spot_id, user_id, date) VALUES (:spot_id, :user_id, :date)");
    $stmt->execute([
        'spot_id' => $like_spot_id,
        'user_id' => $user_id,
        'date' => $date
    ]);
}
?>