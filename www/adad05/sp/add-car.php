<?php

require __DIR__ . '/classes/CarsDB.php';
$carsDB = new CarsDB();

if(isset($_POST)){
    $carsDB->createCar($_POST['model'], $_POST['capacity']);
    Header ('Location: administration-page.php');
}

?>