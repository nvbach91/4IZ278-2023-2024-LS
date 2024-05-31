<?php

require_once '../db/database_class.php';
require_once '../utils/admin-check.php';
session_start();

$ordersDB = new OrdersDB();
$bookOrdersDB = new BookOrdersDB();

$action = $_SERVER['PHP_SELF'];

if (isset($_POST['month'])) {
  $month = $_POST['month'];
} else if (isset($_SESSION['month'])) {
  $month = $_SESSION['month'];
} else {
  $month = null;
}

if (isset($_POST['year'])) {
  $year = $_POST['year'];
} else if (isset($_SESSION['year'])) {
  $year = $_SESSION['year'];
} else {
  $year = null;
}


$_SESSION['month'] = $month;
$_SESSION['year'] = $year;

$orders = $ordersDB->findStatistics($_SESSION['month'], intval($_SESSION['year']));

$money = 0;
foreach ($orders as $order) {
  $money += $order['overall_price'];
}
$orderCount = count($orders);

$months = [
  1 => 'Leden',
  2 => 'Únor',
  3 => 'Březen',
  4 => 'Duben',
  5 => 'Květen',
  6 => 'Červen',
  7 => 'Červenec',
  8 => 'Srpen',
  9 => 'Září',
  10 => 'Říjen',
  11 => 'Listopad',
  12 => 'Prosinec',
];

?>

<?php require '../components/Header.php'; ?>
<div class="comic-container">
  <div class="comic-headline">
    <h1>Finanční přehled</h1>
  </div>
  <div style="border-top: 3px solid grey;">
    <div class="comic-print">
      <div class="user-print">
        <form id="statistics" action="<?php echo $action; ?>" method="POST">
          <div class="statistics">
            <select id="month" name="month" class="comic-select">
              <option value="0">Měsíc</option>
              <?php foreach ($months as $num => $name) : ?>
                <option value="<?php echo $num; ?>" <?php echo (isset($_SESSION['month']) && $_SESSION['month'] == $num) ? 'selected' : ''; ?>>
                  <?php echo $name; ?>
                </option>
              <?php endforeach; ?>
            </select>
            <input id="year" type="text" name="year" class="comic-select" placeholder="<?php echo !empty($_SESSION['year']) ? $_SESSION['year'] : 'Rok' ?>">
          </div>
          <p>Celkové revenue: <?php echo $money; ?> kč</p>
          <p>Počet objednávek: <?php echo $orderCount; ?></p>
        </form>
      </div>
    </div>
  </div>
</div>
<?php require '../components/Footer.php'; ?>

<?php
unset($_SESSION['month']);
?>