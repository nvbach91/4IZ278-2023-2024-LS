<?php

var_dump($_POST);
if (empty($_POST)){
    header("Location: reservation-page.php");
    exit;
}

require __DIR__ . '/classes/ReservationsDB.php';
require __DIR__ .'/classes/AssociatonDB.php';

$reservationsDB = new ReservationsDB();
$associationDB = new AssociationDB();

$isReservationCreated = $reservationsDB->isReservation($_POST['user_id'], $_POST['date'], $_POST['time_id']);
$associationDB->deleteAssociation($isReservationCreated[1], $_POST['car_id']);
Header('Location: reservation-page.php');
exit;

?>