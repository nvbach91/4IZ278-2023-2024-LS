<?php
require_once __DIR__ . '../../config.php';
include BASE_PATH . '/includes/authAdmin.php';
require_once BASE_PATH . '/includes/incl.php';

$id = htmlspecialchars($_GET["id"]);


$reservations = $reservation->getNextTen($id);
$actions->getLastTen($reservations);
