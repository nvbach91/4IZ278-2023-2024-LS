<?php
require 'db.php';

$stmt = $db->prepare('SELECT * FROM spots');
$stmt->execute();
$spots = $stmt->fetchAll();
$spotsFinal = [];
foreach ($spots as $spot) {
    $nextPoint = array($spot['spot_id'], $spot['user_id'], $spot['username'], $spot['title'], $spot['description'], $spot['coordinatesX'], $spot['coordinatesY'], $spot['category'], $spot['image_id'], $spot['created_at']);
    array_push($spotsFinal, $nextPoint);
}
echo json_encode($spotsFinal);
?>