<?php
require 'db.php';
?>
<?php
$delete_comment_id = $_GET['delete_comment_id'];

$stmt = $db->prepare("DELETE FROM comments WHERE comment_id = $delete_comment_id");
$stmt->execute();

header('Location: index.php');
?>