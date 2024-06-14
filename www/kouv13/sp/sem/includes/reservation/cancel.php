<?php
session_start();
require_once '../../config.php';
if (isset($_SESSION['admin'])) {
    include BASE_PATH . '/includes/authAdmin.php';
} else {
    include BASE_PATH . '/includes/auth.php';
}
require_once BASE_PATH . '/includes/incl.php';
$idReservation = htmlspecialchars($_GET['idRes']);
if (isset($_SESSION['admin'])) {
    $idUser = $reservation->getReservation($idReservation);
    $idUser = $idUser->id;
} else {
    $idUser = $_SESSION['iduser'];
}
if ($reservation->cancelReservation($idReservation, $idUser)) {
    if (isset($_SESSION['admin'])) {
        header("Location: ../../admin/?can=1");
        exit();
    } else {
        header("Location: ../../u/?can=1");
        exit();
    }

} else {
    header("Location: ../../u/?can=2");
    exit();
}
