<?php

require_once __DIR__ . '../../config.php';
include BASE_PATH . '/includes/authAdmin.php';
require_once BASE_PATH . '/includes/incl.php';

$idSport = htmlspecialchars($_GET["idSport"]);
$idField = htmlspecialchars($_GET["idField"]);


$status = $db->getStatusFieldSport($idSport, $idField);
var_dump($status);
if ($status === false) {
    $db->addSportField($idSport, $idField);
} else {
    $db->deleteSportField($idSport, $idField);
}
