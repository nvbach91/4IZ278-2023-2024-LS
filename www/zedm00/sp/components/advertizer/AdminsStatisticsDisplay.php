<?php require_once __DIR__ . './../../db/EventsDB.php'; ?>
<?php
include __DIR__ . './../../utils.php';

$eventsDB = new EventsDB;
$stats = $eventsDB->statistics($_SESSION['advertizer_id']);

$totalPrice = 0;
foreach ($stats as $stat) {
    $totalPrice += $stat["total_sold_price"];
}
$events = $eventsDB->getAdvertizerEvents($_SESSION['advertizer_id']);
$eventsNotNull = array_filter($events, function ($event) {
    return $event["cancelled"] !== null;
});

?>
<div class=" container row  d-flex flex-grow-1 ">
    <div class="row d-flex flex-grow-1  ">
        <div class="col-3 text-center">
            <div class="mt-4 ">
                <a href="admin_index.php" class="btn btn-lg btn-outline-secondary"> Zpět</a>
            </div>
        </div>
        <div class="col-9 my-4 ">

            <h1 class="mb-1">Statistiky</h1>

            <div class="row">
                <div class="col-4 "><b>Název akce</b></div>
                <div class="col-4"><b>Prodáno lístků</b></div>
                <div class="col-4"><b>Tržby</b></div>
                <hr>
                <?php foreach ($stats as $stat) : ?>
                    <div class="col-4"><?php echo $stat["event_name"] ?></div>
                    <div class="col-4"><?php echo $stat["total_tickets_sold"] ?></div>
                    <div class="col-4"><?php echo $stat["total_sold_price"] ?></div>
                <?php endforeach; ?>
            </div>
            <hr>
            <div><b>Celkem tržby:</b> <?php echo $totalPrice ?></div>
            <div><b>Celkem akcí:</b> <?php echo count($events) ?></div>
            <div><b>Zrušených akcí:</b> <?php echo count($eventsNotNull) ?></div>


        </div>
    </div>
</div>
