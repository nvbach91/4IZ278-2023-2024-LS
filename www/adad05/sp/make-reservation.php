<?php

if(!isset($_COOKIE['email'])){
    Header('Location: login-page.php');
    exit;
}

// opravneni nedrzet v cookies - pouze ID
if($_COOKIE['privilege'] == 1){
    Header('Location: unauthorized-message.php?reason=hotel-required');
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