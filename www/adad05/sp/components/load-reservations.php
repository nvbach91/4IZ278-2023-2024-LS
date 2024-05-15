<?php

require __DIR__ . '/../classes/ReservationsDB.php';
require __DIR__ . '/../classes/CarsDB.php';

if(!isset($_COOKIE['email'])){
    Header('Location: login-page.php');
    exit;
}

$date;
session_start();
if (empty($_SESSION['date'])) {
    if (!empty($_POST['date'])) {
        $date = $_POST['date'];
        $_SESSION['date'] = $date;
    } else {
        $date = date('Y-m-d');
        $_SESSION['date'] = $date;
    }
} else {
    if (!empty($_POST['date'])) {
        $date = $_POST['date'];
        $_SESSION['date'] = $date;
    } else {
        $date = $_SESSION['date'];
    }

}


$user_email = $_COOKIE['email'];
$user_id = $_COOKIE['user_id'];

$filtered_car;
if (!empty($_POST['car_filter'])) {
    $filtered_car = $_POST['car_filter'];
}

$reservationsDB = new ReservationsDB();

$carsDB = new CarsDB();
$cars;

if (isset($filtered_car)) {
    $cars = $carsDB->findByName($filtered_car);
} else {
    $cars = $carsDB->find();
}


$reservations = [];
foreach ($cars as $car) {
    array_push($reservations, $reservationsDB->findByDateAndCar($date, $car['car_id']));
}

?>

<div class="reservation-div">

    <h1>Rezervační systém</h1>
    <hr class="legend">

    <div style="display:flex; flex-wrap:wrap">
        <div class="form-date-div">
            <form class="form-date" method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                <input type="date" name="date" value="<?php echo $date; ?>">
                <button type="submit">Potvrdit datum</button>
            </form>
            <form class="form-date-2" method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                <input type="date" name="date" value="<?php echo date('Y-m-d'); ?>" style="display: none;">
                <button type="submit">Nastavit dnešení datum</button>
            </form>
        </div>
        <div class="form-date-div-right">
            <form class="form-date" method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                <input list="cars_enum" name="car_filter" placeholder="Filtrovat vůz">
                <datalist id="cars_enum">
                    <?php foreach ($cars as $car) { ?>
                        <option><?php echo $car['model']; ?></option>
                    <?php } ?>
                </datalist>
                <button type="submit">Zobrazit zvolený vůz</button>
            </form>
            <form class="form-date-2" method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                <button type="submit">Zobrazit všechna auta</button>
            </form>
        </div>


    </div>

    <div class="info-row">
        <div class="info-cell">Vůz (počet míst):</div>
        <div class="time-schedule">
            <?php for ($i = 0; $i <= 23; $i++) {
                $h0 = 8 + floor($i / 2);
                $m0 = (($i % 2) == 0) ? '00' : '30';
                $h1 = 8 + floor(($i + 1) / 2);
                $m1 = ((($i + 1) % 2) == 0) ? '00' : '30'; ?>
                <div class="time"><?php echo $h0 . ':' . $m0 ?><br><?php echo $h1 . ':' . $m1 ?></div>
            <?php } ?>
        </div>
    </div>

    <?php for ($i = 0; $i < count($cars); $i++) { ?>
        <div class="reservation-row">
            <div class="car-info-cell"><?php echo $cars[$i]['model'] . ':' ?></div>
            <div class="reservations">
                <?php for ($x = 0; $x < 24; $x++) {

                    $cellType = 0;

                    // ošetření pro první buňku
                    if ($x == 0) {
                        // moje rezervace
                        if ($reservations[$i][$x]['email'] == $user_email and $reservations[$i][$x]['email'] != null) {
                            $cellType = 1;
                        }
                        // rezervace někoho jiného
                        elseif ($reservations[$i][$x]['email'] != null and $reservations[$i][$x]['email'] != $user_email) {
                            $cellType = 2;
                        }
                        // bez rezervace
                        else {
                            // další buňka je moje
                            if ($reservations[$i][$x + 1]['email'] == $user_email) {
                                $cellType = 0;
                            }
                            // další buňka je cizí
                            elseif ($reservations[$i][$x + 1]['email'] != $user_email and $reservations[$i][$x + 1]['email'] != null) {
                                $cellType = 3;
                            }
                            // další buňka nění nikoho
                            else {
                                $cellType = 0;
                            }
                        }
                    }

                    // ošetření pro poslední buňku
                    elseif ($x == 23) {
                        // moje rezervace
                        if ($reservations[$i][$x]['email'] == $user_email and $reservations[$i][$x]['email'] != null) {
                            $cellType = 1;
                        }
                        // rezervace někoho jiného
                        elseif ($reservations[$i][$x]['email'] != null and $reservations[$i][$x]['email'] != $user_email) {
                            $cellType = 2;
                        }
                        // bez rezervace
                        else {
                            // předchozí buňka je moje
                            if ($reservations[$i][$x - 1]['email'] == $user_email) {
                                $cellType = 0;
                            }
                            // předchozí buňka je cizí
                            elseif ($reservations[$i][$x - 1]['email'] != $user_email and $reservations[$i][$x - 1]['email'] != null) {
                                $cellType = 3;
                            }
                            // předchozí buňka nění nikoho
                            else {
                                $cellType = 0;
                            }
                        }
                    }

                    // ošetření pro všechny zbylé buňky
                    else {
                        if ($reservations[$i][$x + 1]['time'] != null and $reservations[$i][$x + 1]['email'] != $user_email) {
                            $cellType = 3;
                        }
                        if (isset($reservations[$i][$x - 1]['time']) and $reservations[$i][$x - 1]['email'] != $user_email) {
                            $cellType = 3;
                        }
                        if ($reservations[$i][$x]['time'] != null and $reservations[$i][$x]['email'] != $user_email) {
                            $cellType = 2;
                        }
                        if ($reservations[$i][$x]['time'] != null and $reservations[$i][$x]['email'] == $user_email) {
                            $cellType = 1;
                        }
                    }

                    switch ($cellType) {
                        case 0: ?>
                            <div class="reservation available button">
                                <form method="post" action="make-reservation.php">
                                    <input name="email" value="<?php echo $user_email; ?>" style="display:none">
                                    <input name="user_id" value="<?php echo $user_id; ?>" style="display:none">
                                    <input name="date" value="<?php echo $date; ?>" style="display:none">
                                    <input name="car_id" value="<?php echo $cars[$i]['car_id']; ?>" style="display:none">
                                    <input name="time_id" value="<?php echo $x; ?>" style="display:none">
                                    <button class="button-reservation" type="submit">+</button>
                                </form>
                            </div> <?php break;
                        case 1: ?>
                            <div class="reservation owned button">
                                <form method="post" action="cancel-reservation.php">
                                    <input name="email" value="<?php echo $user_email; ?>" style="display:none">
                                    <input name="user_id" value="<?php echo $user_id; ?>" style="display:none">
                                    <input name="date" value="<?php echo $date; ?>" style="display:none">
                                    <input name="car_id" value="<?php echo $cars[$i]['car_id']; ?>" style="display:none">
                                    <input name="time_id" value="<?php echo $x; ?>" style="display:none">
                                    <button class="button-reservation" type="submit">✔</button>
                                </form>
                            </div> <?php break;
                        case 2: ?>
                            <div class="reservation unavailable">X</div> <?php break;
                        case 3: ?>
                            <div class="reservation blocked">X</div> <?php break;
                    }
                } ?>
            </div>
        </div>
    <?php } ?>

</div>