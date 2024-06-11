<?php
session_start();
require_once '../../config.php';
if (isset($_SESSION['admin'])) {
    include BASE_PATH . '/includes/authAdmin.php';
} else {
    include BASE_PATH . '/includes/auth.php';
}
require BASE_PATH . '/includes/reservation/reservation.class.php';
require BASE_PATH . '/db/db.class.php';
$reservation = new reservation();
$db = new db();
$idReservation = htmlspecialchars($_GET['idRes']);
$idUser = $_SESSION['iduser'];

if ($db->cancelReservation($idReservation, $idUser)) {
    header("Location: ../../u/?can=1");
    exit();
} else {
    header("Location: ../../u/?can=2");
    exit();
}
