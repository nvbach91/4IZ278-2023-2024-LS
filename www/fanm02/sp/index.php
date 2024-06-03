<?php
require __DIR__ . '/components/header.php';

require_once 'db/Meals.php';
require_once 'db/Dorms.php';
require_once 'db/Users.php';

$mealsDb = new MealsDB();
$dormsDb = new DormsDB();
$usersDb = new UsersDB();

$meals = $mealsDb->find();

$paginations = 1;

?>

<main class='container' style='max-width: 90%; min-height: 80vh;'>
    <hr>
    <div class='products-wrapper'>
        <div class='row'>
            <?php foreach ($meals as $meal) : ?>
                <div class='col-md-4'>
                    <div class='card' style='width: 350px; height: min-content;'>
                        <img class='card-img-top' style='width: 100%; height: 150px; object-fit: cover;' src='<?php echo $meal['photo_url']; ?>' alt='<?php echo $meal['title']; ?> photo'>
                        <div class='card-body'>
                            <h5 class='card-title'><?php echo $meal['title']; ?></h5>
                            <h6 class='card-subtitle mb-2 text-muted'><?php echo $meal['price']; ?>$</h6>
                            <p class='card-text'><?php echo $meal['description']; ?></p>
                            <button type='button' class='btn btn-primary' data-toggle='modal' data-target='#bmealModal<?php echo $meal['id']; ?>'>View Details</button>
                        </div>
                    </div>
                </div>

                <div class='modal fade' id='bmealModal<?php echo $meal['id']; ?>' tabindex='-1' role='dialog' aria-labelledby='bmealModalLabel<?php echo $meal['id']; ?>' aria-hidden='true'>
                    <div class='modal-dialog' role='document'>
                        <div class='modal-content'>
                            <div class='modal-header'>
                                <h5 class='modal-title' id='bmealModalLabel<?php echo $meal['id']; ?>'><?php echo $meal['title']; ?></h5>
                                <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                                    <span aria-hidden='true'>&times;</span>
                                </button>
                            </div>
                            <div class='modal-body'>
                                <p><?php echo $meal['description']; ?></p>
                                <p><b><?php echo date_format(date_create($meal['pickup_time']), 'Y/m/d H:i'); ?></b></p>
                                <p><?php echo $dormsDb->getDormitory($meal['pickup_dorm'])['name'];
                                    if ($meal['pickup_room'] != null) {
                                        echo ' (' . $meal['pickup_room'] . ')';
                                    } ?></p>
                                <p>Price: <?php echo $meal['price']; ?>$</p>
                            </div>
                            <div class='modal-footer'>
                                <button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>
                                <a href='paywall.php?meal_id=<?php echo $meal['id'] ?>' class='btn btn-primary'>Purchase</a>
                            </div>
                        </div>
                    </div>
                </div>
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
</main>
<?php require __DIR__ . '/components/footer.php' ?>