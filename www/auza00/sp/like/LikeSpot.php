<?php
session_start();
require __DIR__ . '/../db/LikesDB.php';
?>
<?php
$likesDB = new LikesDB();
$likes = $likesDB->find();

$user_id = $_SESSION['user_id'];
$like_spot_id = $_GET['like_spot_id'];
$date = date('Y-m-d H:i:s');

$alreadyLiked = false;

foreach ($likes as $like) {
    if ($like['spot_id'] == $like_spot_id && $like['user_id'] == $user_id) {
        $alreadyLiked = true;
        break;
    }
}

if ($alreadyLiked == false) {
    $likesDB->likeSpot(['spot_id' => $like_spot_id, 'user_id' => $user_id, 'date' => $date]);
}
?>