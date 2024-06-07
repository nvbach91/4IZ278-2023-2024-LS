<?php

require __DIR__ . '/components/header.php';

require_once 'db/Meals.php';
require_once 'db/Dorms.php';
require_once 'db/Users.php';

$mealsDb = new MealsDB();
$dormsDb = new DormsDB();
$usersDb = new UsersDB();

$productsPerPage = 6;

$offset = 0;
$sort = 'pickup_time';
$dir = 'asc';
$search = '';

if (isset($_GET['offset'])) {
    $offset = $_GET['offset'];
}

if (isset($_GET['sort'])) {
    $sort = $_GET['sort'];
}

if (isset($_GET['dir'])) {
    $dir = $_GET['dir'];
}

$visibleMeals = [];

if (isset($_GET['search'])) {
    $search = htmlspecialchars($_GET['search']);
    $meals = $mealsDb->searchMeals($search, $sort, $dir);
    $paginations = ceil(count($meals) / $productsPerPage);
    $visibleMeals = array_slice($meals, $offset, $productsPerPage);
}
else {
    $meals = $mealsDb->getAvailableMeals($sort, $dir);
    $paginations = ceil(count($meals) / $productsPerPage);
    $visibleMeals = array_slice($meals, $offset, $productsPerPage);
}
?>

<main class='container' style='max-width: 90%; min-height: 80vh;'>
    <div class="space"></div>
    <div class="space"></div>
    <div class="top-bar">
        <form action="index.php" class="search-container" method="GET">
            <input type="hidden" name="sort" value="<?php echo $sort; ?>">
            <input type="hidden" name="dir" value="<?php echo $dir; ?>">
            <input type="text" value="<?php echo $search; ?>" name="search" class="form-control" placeholder="Search for meals">
            <button type="submit" class="btn btn-primary btn-search">Search</button>
        </form>
        <div class="sort-container">
            <div class='sort-options'>
                <select id='sort' name='sort' class='form-control' onchange="location = this.value;">
                    <option <?php if($sort == 'pickup_time'){echo "selected";} ?> value='index.php?search=<?php echo $search; ?>&offset=<?php echo $offset; ?>&sort=pickup_time&dir=<?php echo $dir; ?>'>Date</option>
                    <option <?php if($sort == 'price'){echo "selected";} ?> value='index.php?search=<?php echo $search; ?>&offset=<?php echo $offset; ?>&sort=price&dir=<?php echo $dir; ?>'>Price</option>
                </select>
            </div>
            <div class='sort-options'>
                <a href="index.php?search=<?php echo $search; ?>&offset=<?php echo $offset; ?>&sort=<?php echo $sort; ?>&dir=asc" class='btn <?php if($dir == 'asc'){echo "btn-primary";}else{echo "btn-secondary";} ?>' id='ascBtn'>ASC</a>
                <a href="index.php?search=<?php echo $search; ?>&offset=<?php echo $offset; ?>&sort=<?php echo $sort; ?>&dir=desc" class='btn <?php if($dir == 'desc'){echo "btn-primary";}else{echo "btn-secondary";} ?>' id='descBtn'>DESC</a>
            </div>
        </div>
    </div>
    <div class='products-wrapper'>
        <hr>
        <div class='row'>
            <?php foreach ($visibleMeals as $meal) : ?>
                <?php
                include __DIR__ . '/components/info-card.php'
                ?>

                <?php
                include __DIR__ . '/components/info-modal.php';
                ?>
            <?php endforeach; ?>
        </div>
        <hr>

        <div class="pagination-container">
            <ul class='pagination'>
                <?php for ($i = 0; $i < $paginations; $i++) : ?>
                    <li class='page-item <?php echo isset($_GET['offset']) && ($_GET['offset'] / $productsPerPage) == $i ? 'active' : '' ?><?php echo !isset($_GET['offset']) && $i == 0 ? 'active' : '' ?>'><a class='page-link' href='?search=<?php echo $search; ?>&offset=<?php echo $i * $productsPerPage ?>&sort=<?php echo $sort; ?>&dir=<?php echo $dir;?>'><?php echo $i + 1 ?></a></li>
                <?php endfor; ?>
            </ul>
        </div>
    </div>
</main>
<?php require __DIR__ . '/components/footer.php' ?>