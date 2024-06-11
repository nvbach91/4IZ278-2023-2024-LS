<?php
session_start();
require __DIR__ . '/../db/CommentDB.php';
?>
<?php
$commentDB = new CommentDB();
$comments = $commentDB->findBy('spot_id', $_GET['spot_id']);

echo json_encode($comments);
?>