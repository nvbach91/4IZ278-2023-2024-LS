<?php
require __DIR__ . '/components/header.php';
require __DIR__ . '/db/Meals.php';
require __DIR__ . '/db/Dorms.php';
require __DIR__ . '/db/Orders.php';
require __DIR__ . '/db/Users.php';
require __DIR__ . '/db/Messages.php';

/*
$productsCount = $db->query('SELECT COUNT(good_id) FROM cv08_goods')->fetchColumn();
$productsCount = 4;
$paginations = ceil($productsCount / $productsPerPage);
$productsOnLastPagination = $productsCount % $productsPerPage;

$offset = 0;

if (isset($_GET['offset'])) {
    $offset = $_GET['offset'];
}

$DBproducts = $db->prepare('SELECT * FROM cv08_goods ORDER BY good_id DESC LIMIT :limit OFFSET :offset');
$DBproducts->bindValue(':limit', $productsPerPage, PDO::PARAM_INT);
$DBproducts->bindValue(':offset', $offset, PDO::PARAM_INT);
$DBproducts->execute();
$products = $DBproducts->fetchAll();
*/

if (!isset($_COOKIE['display_name'])) {
    header('Location: login.php');
    exit;
}

$ordersDb = new OrdersDB();
$mealsDb = new MealsDB();
$dormsDb = new DormsDB();
$usersDb = new UsersDB();
$messagesDb = new MessagesDB();

$registeredUser = $usersDb->getUser($_COOKIE['display_name'], '');

if ($registeredUser == null) {
    setcookie('display_name', '', -1, "/");
    header('Location: login.php');
    exit;
}

$boughtMeals = $ordersDb->getBoughtMeals($registeredUser['id']);
$sellingMeals = $ordersDb->getSellingMeals($registeredUser['id']);

$paginations = 1;
?>
<script>
    let registeredUserId = <?php echo json_encode($registeredUser['id']); ?>;
</script>

<main class='container' style='max-width: 90%;min-height: 100vh;'>
    <div style='display: flex; flex-direction: column; justify-content: center; margin-top: 50px'>
        <div style="display: flex; justify-content:center; align-items: center;">
            <button class="tablinks tablink-left btn btn-primary" id="defaultOpen" onclick="openTab(event, 'bought')">Bought</button>
            <button class="tablinks tablink-right btn btn-primary" onclick="openTab(event, 'selling')">Selling</button>
        </div>

        <div id="bought" class="tabcontent">
            <hr>
            <?php
                include __DIR__ . '/components/bought-meals.php';
            ?>
        </div>

        <div id="selling" class="tabcontent">
            <div style='display: flex; justify-content: center; margin-top: 15px'>
                <nav>
                    <div style='display: flex; justify-content: center'> <a class='btn btn-primary' href='create-listing.php'>Vytvořit nabídku</a>
                    </div>
                    <hr>
                </nav>
            </div>
            <?php
                include __DIR__ . '/components/selling-meals.php';
            ?>
        </div>
    </div>
</main>
<?php include __DIR__ . '/components/footer.php' ?>