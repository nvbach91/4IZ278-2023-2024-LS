<?php
session_start();
require __DIR__ . '/../db/LikesDB.php';
?>
<?php
$likesDB = new LikesDB();

$user_id = $_SESSION['user_id'];
$unlike_spot_id = $_GET['unlike_spot_id'];
$date = date('Y-m-d H:i:s');

$likesDB->unlikeSpot($unlike_spot_id,  $user_id);
?>