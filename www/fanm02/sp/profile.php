<?php
require __DIR__ . '/components/header.php';
require __DIR__ . '/db/Meals.php';
require __DIR__ . '/db/Dorms.php';
require __DIR__ . '/db/Orders.php';
require __DIR__ . '/db/Users.php';
require __DIR__ . '/db/Messages.php';

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
    session_destroy();
    header('Location: login.php');
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    do {
        if(!isset($_POST['mealId'])){
            break;
        }

        $mealId = $_POST['mealId'];

        if (empty($_POST['title']) || empty($_POST['description']) || empty($_POST['pickup_time']) || empty($_POST['pickup_dorm']) || empty($_POST['pickup_room']) || empty($_POST['price'])) {
            break;
        }

        $mealsDb->updateMealInfo($mealId, $_POST['title'], $_POST['description'], $_POST['pickup_time'], $_POST['pickup_dorm'], $_POST['pickup_room'], $_POST['price']);
    } while(0);

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