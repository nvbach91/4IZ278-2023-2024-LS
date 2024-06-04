<?php
require_once './db/Meals.php';
require_once './db/Users.php';

$mealsDb = new MealsDB();
$usersDb = new UsersDB();

$registeredUser = $usersDb->getUser($_COOKIE['display_name'], '');

$boughtMeals = $ordersDb->getBoughtMeals($registeredUser['id']);
?>

<div class='products-wrapper'>
    <div class='row'>
        <?php if (count($boughtMeals) == 0): ?>
            No bought meals yet.
        <?php endif; ?>
        <?php foreach ($boughtMeals as $meal) : ?>
            <?php
                include './components/bought-card.php';
            ?>

            <?php
                include './components/info-modal.php';
            ?>

            <?php
                include './components/bought-chat-modal.php';
            ?>
        <?php endforeach; ?>
    </div>
    <hr>
</div>