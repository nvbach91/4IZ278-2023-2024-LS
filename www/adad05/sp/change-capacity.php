<?php

require __DIR__ . '/classes/CarsDB.php';
$carsDB = new CarsDB();

if(isset($_POST)){
    $carsDB->changeCapacity($_POST['car_id'], $_POST['capacity']);
    Header ('Location: administration-page.php?edit-mode=vehicles');
}

?>