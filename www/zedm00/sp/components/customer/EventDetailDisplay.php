<?php
require_once __DIR__ . './../../db/EventsDB.php';
require_once __DIR__ . './../../db/TicketsDB.php';
include __DIR__ . './../../utils.php';
$eventsDB = new EventsDB;
$ticketsDB = new TicketsDB;
$event_id = $_GET['id'];


if (isset($_GET['payment']) && $_GET["payment"] == 'ready') {
    $ticketsDB->payTicket($event_id, $_SESSION['customer_id']);
    header("Location: event_detail.php?id=" . $event_id);
    return;
}

if ($event_id != null) {
    $event = $eventsDB->findEvent($event_id);

    $ticket = $ticketsDB->findTicketForUserEvent($event_id, $_SESSION['customer_id']);
    $ticketPaid = $ticket["paid"] ?? false;
    $ticketConfirmed = $ticket["confirmed"] ?? false;

} else {
    echo "The id is null";
    return;
}

?>


<div class="container my-4">
    <div>
        <img class="card-img-top product-image img-fluid"
             src="<?php echo $event['picture'] ? $event['picture'] : 'https://i0.wp.com/sigmamaleimage.com/wp-content/uploads/2023/03/placeholder-1-1.png?resize=300%2C200&ssl=1'; ?>"
             alt="event_picture"
             onerror="this.onerror=null; this.src='https://i0.wp.com/sigmamaleimage.com/wp-content/uploads/2023/03/placeholder-1-1.png?resize=300%2C200&ssl=1';"
        >
        <div>
            <h1 class="my-4"><?php echo $event['name']; ?></h1>
            <b><?php echo formatDateTimestamp($event['time']) . ", " . $event['address']; ?> </b>
            <hr>

            <p><?php echo $event['description']; ?></p>
            <p>Kapacita: <?php echo $event['capacity']; ?></p>
            <p>Typ: <?php echo $event['type']; ?></p>
            <hr>

            <h3><?php echo formatPrice($event['price']); ?></h3>
            <hr>
            <?php if (!isset($_GET['payment']) && !$ticketPaid && !$ticketConfirmed): ?>
                <a href="event_detail.php?id=<?php echo $event_id ?>&payment=ready" class="btn btn-lg btn-primary">Koupit</a>
            <?php endif; ?>

            <?php
            require './vendor/autoload.php';

            use Endroid\QrCode\Builder\Builder;
            use Endroid\QrCode\Writer\PngWriter;

            if ($ticketPaid) {
                $text = 'https://example.com?id=' . $event_id;
                $result = Builder::create()
                    ->writer(new PngWriter())
                    ->data($text)
                    ->build();

                // Generate a data URI
                $dataUri = $result->getDataUri();
            }

            ?>

            <?php if (isset($dataUri) && ($ticketPaid && !$ticketConfirmed)): ?>
                <div class="">
                    <img src="<?php echo $dataUri; ?>"/>
                    <p>
                        Zaplaťte a vyčkejte na potvrzení platby pořadatelem.
                    </p>
                </div>
            <?php endif; ?>

            <?php if ($ticketConfirmed): ?>
                <div class="">
                    <p>
                        Platba byla úspěšná. Děkujeme za nákup.
                        Kód vaší vstupenky: <?php echo $ticket['code']; ?>
                    </p>
                </div>
            <?php endif; ?>

        </div>


    </div>
</div>

