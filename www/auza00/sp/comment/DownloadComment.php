<?php
session_start();
require __DIR__ . '/../db/CommentDB.php';
?>
<?php
$commentDB = new CommentDB();
$comments = $commentDB->findBy('spot_id', $_GET['spot_id']);
$sent_data = null;

echo json_encode($comments);
?>