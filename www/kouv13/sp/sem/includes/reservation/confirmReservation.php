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
if (empty($_POST['ids'])) {
    header("Location: ../../u");
    exit();
}
$array = $reservation->sortArray(json_decode($_POST['ids'], true));

$monday = htmlspecialchars($_POST['monday']);

$array = $reservation->correctDates($array, $monday);
$two_weeks_sunday = date('Y-m-d', strtotime('next sunday + 2 week'));

$idUser = $_SESSION['iduser'];
$price = $_SESSION['price'];
$idField = $_SESSION['idfield'];
$idSport = htmlspecialchars($_POST['sport']);

if (isset($_SESSION['admin'])) {
    $status = '2';
} else {
    $status = '1';
}

if (isset($array) && isset($monday) && isset($idField) && isset($idSport) && isset($price)) {

    $reservationIds = [];
    foreach ($array as $element) {
        $isFull = $db->isFull($element->time, $element->date, $idField);
        var_dump($isFull);
        if (date('Y-m-d') <= $element->date && $element->date <= $two_weeks_sunday && empty($isFull)) {
            $id = $db->addReservation($idUser, $idField, $idSport, $element->date, $element->time, $element->day, $price, $status);
            array_push($reservationIds, $id);
        } else if (isset($_SESSION['admin']) && date('Y-m-d') <= $element->date && empty($isFull)) {
            $id = $db->addReservation($idUser, $idField, $idSport, $element->date, $element->time, $element->day, $price, $status);
            array_push($reservationIds, $id);
        }
    }
    if (empty($reservationIds)) {
        //nevybrane casy
        header("Location: ../../u?checkout=2");
        exit();
    } else {
        $string = json_encode($reservationIds);
        if (isset($_SESSION['admin'])) {
            header("Location: ../../admin?checkout=1");
            exit();
        } else {
            $reservations = [];
            foreach ($reservationIds as $id) {
                $res = $db->getMyReservation($_SESSION['iduser'], htmlspecialchars($id));
                array_push($reservations, $res);
            }
            $html1 = '<!DOCTYPE html>
                    <html>
                    
                    <head>
                        <meta charset="UTF-8">
                        <title>Nová rezervace</title>
              <style>        
              body {
              font-family: Arial, sans-serif;
              background-color: #f4f4f4;
              margin: 0;
              padding: 20px;
            }
            h2 {
                margin-bottom: 10px;
            }
            .col-6 {
                width: 50%;
                float: left;
            }
            .border-bottom {
                border-bottom: 1px solid grey;
            }    
            .row {
                display: flex;
            }
            #price {
                text-align: right;
            }
            .text-end {
            text-align: right;
            }

            
            </style></head><body>';
            $html2 = '<p id="price">Celková cena: ' . count($reservationIds) * $price . ' Kč</p></body></html>';
            $html = $html1 . $reservation->getCheckoutReservations($reservations) . $html2;
            echo $html;
            $reservation->sendCheckout($html);
            header("Location: ../../u/checkout?ids=$string");
            exit();
        }
    }
} else {
    //chyba pri rezervaci
    header("Location: ../../u?checkout=3");
    exit();
}
