<?php
session_start();
require 'db.php';
?>
<?php

$user_id = $_SESSION['user_id'];
$unlike_spot_id = $_GET['unlike_spot_id'];
$date = date('Y-m-d H:i:s');

$stmt = $db->prepare("DELETE FROM likes WHERE spot_id = $unlike_spot_id AND user_id = $user_id");
$stmt->execute();

?>