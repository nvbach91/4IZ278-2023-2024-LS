<?php
require_once './db/Meals.php';
require_once './db/Users.php';

$mealsDb = new MealsDB();
$usersDb = new UsersDB();

$registeredUser = $usersDb->getUser($_COOKIE['display_name'], '');

$sellingMeals = $ordersDb->getSellingMeals($registeredUser['id']);

$productsPerPage = 6;
$paginations = 1

?>

<div class='products-wrapper'>
    <div class='row'>
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
    <div class="pagination-container">
        <ul class='pagination'>
            <?php for ($i = 0; $i < $paginations; $i++) : ?>
                <li class='page-item <?php echo isset($_GET['offset']) && ($_GET['offset'] / $productsPerPage) == $i ? 'active' : '' ?><?php echo !isset($_GET['offset']) && $i == 0 ? 'active' : '' ?>'><a class='page-link' href='?offset=<?php echo $i * $productsPerPage ?>'><?php echo $i + 1 ?></a></li>
            <?php endfor; ?>
        </ul>
    </div>
</div>