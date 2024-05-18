<?php

if(!isset($_COOKIE['email'])){
    Header('Location: login-page.php');
    exit;
}

if($_COOKIE['privilege'] == 1){
    Header('Location: administration-page.php');
    exit;
}

if (empty($_POST)){
    header("Location: reservation-page.php");
    exit;
}

require __DIR__ . '/classes/ReservationsDB.php';
require __DIR__ .'/classes/AssociatonDB.php';
require __DIR__ .'/classes/EditsDB.php';

$reservationsDB = new ReservationsDB();
$associationDB = new AssociationDB();
$editsDB = new EditsDB();

$isDateTimeCreated = $editsDB->isEdit($_POST['date'], $_POST['car_id']);
if ($isDateTimeCreated[0]){
    if (strtotime($_POST['date_time']) < strtotime($isDateTimeCreated[2])) {
        header('Location: reservation-page.php');
        exit;
    } else {
        $editsDB->updateEdit($isDateTimeCreated[1], date('Y-m-d G:i:s'));
    }
} else {
    $editsDB->createEdit($_POST['date'], $_POST['car_id'], date('Y-m-d G:i:s'));
}

$isReservationCreated = $reservationsDB->isReservation($_POST['user_id'], $_POST['date'], $_POST['time_id']);
$associationDB->deleteAssociation($isReservationCreated[1], $_POST['car_id']);
Header('Location: reservation-page.php');
exit;

?>