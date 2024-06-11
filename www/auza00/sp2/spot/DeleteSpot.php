<?php
session_start();
require __DIR__ . '/../db/SpotsDB.php';
?>
<?php
$spotsDB = new SpotsDB();
$spots = $spotsDB->find();

$delete_spot_id = $_GET['delete_spot_id'];

$spotsDB->deleteSpot($delete_spot_id);

header('Location: /../index.php');
?>