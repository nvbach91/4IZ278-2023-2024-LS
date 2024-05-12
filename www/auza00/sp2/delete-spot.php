<?php
require 'db.php';
?>
<?php
$delete_spot_id = $_GET['delete_spot_id'];

$stmt = $db->prepare("DELETE FROM spots WHERE spot_id = $delete_spot_id");
$stmt->execute();

header('Location: index.php');
?>