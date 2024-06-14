<?php
session_start();
require __DIR__ . '/../db/SpotsDB.php';
?>
<?php
$spotsDB = new SpotsDB();

$delete_spot_id = $_GET['delete_spot_id'];
$spot = $spotsDB->findBy('spot_id', $delete_spot_id);

$delete_img_name = $spot[0]['image_id'];
if ($delete_img_name != null){
    unlink("../spot-img/{$delete_img_name}");
}

$spotsDB->deleteSpot($delete_spot_id);

header('Location: /../index.php');
?>