<?php require_once __DIR__ . './../../db/EventsDB.php'; ?>
<?php require_once __DIR__ . './../../db/AdvertizerDB.php'; ?>
<?php
include __DIR__ . './../../utils.php';

$eventsDB = new EventsDB;
$advertizerDB = new AdvertizerDB;
$events = $eventsDB->getAdvertizerEvents($_SESSION['advertizer_id']);

if (isset($_GET['cancel'])) {
    $eventsDB->cancelEvent($_GET['cancel']);
}

$advertizer = $advertizerDB->findAdvertizerById($_SESSION['advertizer_id']);
$paymentInfoIsSet = $advertizer['account_number'] != null && $advertizer['bank_code'] != null;

if (!$paymentInfoIsSet) {
    echo '<div class="alert alert-danger  gap-3">';
    echo '<div> Pro vytvoření nové události nastavte platební údaje.</div>';
    echo '</div>';
}


?>


<div class=" container  d-flex flex-grow-1  justify-content-center ">
    <div class="row d-flex flex-grow-1">
        <div class="col-3 text-center d-flex f">
            <div class="mt-4 ">
                <?php if ($paymentInfoIsSet): ?>
                    <a href="admin_create_event.php" class="btn btn-primary btn-lg"> Nová událost</a>
                <?php endif; ?>
                <a href="admin_tickets.php" class="btn btn-outline-secondary btn-lg mt-2"> Lístky k potvrzení</a>
                <a href="admin_statistics.php" class="btn btn-outline-secondary btn-lg mt-2"> Statistiky</a>
                <a href="admin_payment_info.php" class="btn btn-outline-secondary btn-lg mt-2"> Nastavení platebních
                    údajů</a>
            </div>
        </div>
        <div class="col-9 row my-4">

            <?php foreach ($events as $event) : ?>
                <div class="col-lg-4 col-md-6 mb-4 bbb">
                    <div class="card h-100 product">

                        <img class="card-img-top product-image img-fluid"
                             src="<?php echo $event['picture'] ?? 'https://i0.wp.com/sigmamaleimage.com/wp-content/uploads/2023/03/placeholder-1-1.png?resize=300%2C200&ssl=1'; ?>"
                             alt="event_picture"
                             onerror="this.onerror=null; this.src='https://i0.wp.com/sigmamaleimage.com/wp-content/uploads/2023/03/placeholder-1-1.png?resize=300%2C200&ssl=1';"
                        >

                        <div class="card-body">
                            <h4 class="card-title">
                                <?php echo $event['name']; ?>
                            </h4>

                            <div class="event-time">
                                <?php echo formatDateTimestamp($event['time']); ?>
                            </div>
                            <div class="event-address">
                                <?php echo $event['address']; ?>
                            </div>
                            zakoupeno lístků:
                            <h5 class="mb-0 mt-2"><?php echo $event['tickets_sold'] . "/" . $event['capacity']; ?></h5>

                        </div>
                        <div class="card-footer d-flex justify-content-between align-items-center">
                            <?php if (!$event['cancelled']): ?>
                                <a href="?cancel=<?php echo $event['id']; ?>"
                                   class="btn btn-outline-secondary">Zrušit</a>

                            <?php else: ?>
                                <h5 class="mb-0 text-danger">Zrušeno</h5>
                            <?php endif; ?>
                            <a class="btn btn-outline-primary rounded"
                               href="admin_create_event.php?id=<?php echo $event['id']; ?>">Více informací</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>

        </div>
    </div>
</div>


