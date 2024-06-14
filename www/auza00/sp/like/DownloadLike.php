<?php
session_start();
require __DIR__ . '/../db/LikesDB.php';
?>
<?php
$likesDB = new LikesDB();
$likes = $likesDB->find();

$user_id = null;
$username = null;

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $username = $_SESSION['user_username'];
}

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

echo json_encode([$likedSpots, $allLikes, $user_id, $username]);
?>