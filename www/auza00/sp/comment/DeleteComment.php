<?php
session_start();
require __DIR__ . '/../db/CommentDB.php';
?>
<?php
$commentDB = new CommentDB();
$delete_comment_id = $_POST['delete_comment_id'];

$commentDB->deleteBy('comment_id', $delete_comment_id);

echo('comment deleted');
//header('Location: /../index.php');
?>