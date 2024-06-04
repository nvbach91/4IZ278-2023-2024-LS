<?php 
require_once 'db/Meals.php';
require_once 'db/Orders.php';
require_once 'db/Users.php';

$mealsDb = new MealsDB();
$ordersDb = new OrdersDB();
$usersDb = new UsersDB();

if(!isset($_COOKIE['display_name'])){
    header('Location: login.php');
    exit();
}

if(!isset($_GET['meal_id'])){
    header('Location: index.php');
    exit();
}

$meal = $mealsDb->getMeal($_GET['meal_id']);

if($meal['status'] != 1){
    header('Location: index.php');
    exit();
}

$registeredUser = $usersDb->getUser($_COOKIE['display_name'], '');

if($registeredUser == null){
    setcookie('display_name', '', -1, "/");
    header('Location: login.php');
    exit();
}

if($registeredUser['id'] == $meal['chef_id']){
    header('Location: index.php');
    exit();
}

$ordersDb->create([$registeredUser['id'], $meal['chef_id'], $meal['id']]);
$mealsDb->updateMealStatus($meal['id'], 2);

header('Refresh: 3; url=profile.php');
?>

<!DOCTYPE html>
<html>
<head>
    <title>Paywall</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="container">
        <p>Wait while purchase is being processed..</p>
    </div>
</body>
</html>
