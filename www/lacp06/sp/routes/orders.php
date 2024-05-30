<?php

require_once '../db/database_class.php';
require_once '../utils/user-check.php';
require_once '../utils/check-privileges.php';

$ordersDB = new OrdersDB();
$bookOrdersDB = new BookOrdersDB();
$usersDB = new UsersDB();
$booksDB = new BooksDB();

$user = $usersDB->findUser($_COOKIE["name"]);
if ($privileges < 3) {
  $nItems = $ordersDB->countForUser($user[0]["id"]);
} else {
  $nItems = $ordersDB->countAll();
}

$nItemsPerPage = 5;
$nPaginations = ceil($nItems / $nItemsPerPage);

if (isset($_GET["page"])) {
  $page = $_GET["page"];
  $offset = ($page - 1) * $nItemsPerPage;
} else {
  $page = 1;
  $offset = 0;
}

if ($privileges < 3) {
  $orders = $ordersDB->findForUser($user[0]["id"], $offset, $nItemsPerPage);
} else {
  $orders = $ordersDB->findAll($offset, $nItemsPerPage);
}

$orders_content = [];

foreach ($orders as $order) {
  $order_content = $bookOrdersDB->findAll($order["id"]);
  $orders_content[$order["id"]] = $order_content;
}

?>

<?php require '../components/Header.php'; ?>
<div class="comic-container">
  <div class="comic-headline">
    <?php if ($privileges > 2) : ?>
      <h1>Všechny objednávky</h1>
    <?php else : ?>
      <h1>Vaše objednávky</h1>
    <?php endif; ?>
  </div>
  <div style="border-top: 3px solid grey;">
    <div class="comic-print">
      <div class="user-print">
        <?php foreach ($orders as $order) : ?>
          <div class="order-container">
            <p class="order-number">Číslo objednávky: <?php echo $order["id"]; ?></p>
            <div class="details">
              <?php if ($privileges > 2) : ?>
                <p>Uživatel:</p>
                <p><b><?php echo $usersDB->findUserById($order["user_id"])[0]["email"]; ?></b></p>
              <?php endif; ?>
              <p>Datum objednání:</p>
              <p><?php echo date("d.m. Y", strtotime($order["timestamp"])); ?></p>
              <p>Cena:</p>
              <p><?php echo number_format($order["overall_price"], 2, ',', ' '); ?> Kč</p>
              <p>Stav:</p>
              <p><?php echo $order["state"]; ?></p>
            </div>
            <p><b>Obsah objednávky:</b></p>
            <div class="content">
              <?php foreach ($orders_content[$order["id"]] as $content) : ?>
                <p><?php echo $booksDB->findById($content['book_id'])[0]['name'] ?></p>
                <p><?php echo $content['units'] ?> ks</p>
                <p><?php echo number_format($content['price'] * $content['units'], 2, ',', ' '); ?> kč</p>
              <?php endforeach; ?>
            </div>
          </div>
        <?php endforeach; ?>
        <?php require '../components/Pagination.php'; ?>
      </div>
    </div>
  </div>
</div>
<?php require '../components/Footer.php'; ?>