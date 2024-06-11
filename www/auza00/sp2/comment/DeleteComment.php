<?php
session_start();
require __DIR__ . '/../db/CommentDB.php';
?>
<?php
$commentDB = new CommentDB();

$delete_comment_id = $_GET['delete_comment_id'];

$commentDB->deleteBy('comment_id', $delete_comment_id);

header('Location: /../index.php');
?>