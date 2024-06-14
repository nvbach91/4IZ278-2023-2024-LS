<?php
session_start();
require __DIR__ . '/../db/SpotsDB.php';
?>
<?php
$spotsDB = new SpotsDB();
$spots = $spotsDB->find();

$spotsFinal = [];

foreach ($spots as $spot) {
    $nextPoint = array($spot['spot_id'], $spot['user_id'], $spot['username'], $spot['title'], $spot['description'], $spot['coordinatesX'], $spot['coordinatesY'], $spot['category'], $spot['image_id'], $spot['created_at']);
    array_push($spotsFinal, $nextPoint);
}

echo json_encode($spotsFinal);
?>