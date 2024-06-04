<?php
require_once './db/Meals.php';
require_once './db/Users.php';

$mealsDb = new MealsDB();
$usersDb = new UsersDB();

$registeredUser = $usersDb->getUser($_COOKIE['display_name'], '');

$sellingMeals = $ordersDb->getSellingMeals($registeredUser['id']);
?>
<div class='products-wrapper'>
    <div class='row'>
    <?php if (count($sellingMeals) == 0): ?>
            No meals to sell.
        <?php endif; ?>
        <?php foreach ($sellingMeals as $meal) : ?>
            <?php
                include './components/selling-card.php';
            ?>

            <?php
                include './components/edit-modal.php';
            ?>

            <?php
                include './components/selling-chat-modal.php';
            ?>
        <?php endforeach; ?>
    </div>
    <hr>
</div>