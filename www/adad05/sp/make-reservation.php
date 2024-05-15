<?php

if (empty($_POST)){
    header("Location: reservation-page.php");
}

require __DIR__ . '/classes/ReservationsDB.php';
require __DIR__ .'/classes/AssociatonDB.php';

$reservationsDB = new ReservationsDB();
$associationDB = new AssociationDB();

$isReservationCreated = $reservationsDB->isReservation($_POST['user_id'], $_POST['date'], $_POST['time_id']);
if ($isReservationCreated[0]){
    echo $isReservationCreated[1];
    echo $_POST['car_id'];
    $associationDB->createAssociation($isReservationCreated[1], $_POST['car_id']);
    Header('Location: reservation-page.php');
    exit;
} else {
    $reservationsDB->createReservation($_POST['user_id'], $_POST['date'], $_POST['time_id']);
    $isReservationCreated = $reservationsDB->isReservation($_POST['user_id'], $_POST['date'], $_POST['time_id']);
    $associationDB->createAssociation($isReservationCreated[1], $_POST['car_id']);
    Header('Location: reservation-page.php');
    exit;
}

?>