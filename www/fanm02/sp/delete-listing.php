<?php
require_once './db/Meals.php';

$mealsDb = new MealsDB();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['meal_id'])) {
        $mealsDb->deleteMeal($_POST['meal_id']);
    }
}

header('Location: profile.php');

?>