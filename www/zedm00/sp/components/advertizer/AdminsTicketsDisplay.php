<?php

require_once __DIR__ . './../../db/TicketsDB.php';
include __DIR__ . './../../utils.php';

$ticketsDB = new TicketsDB;
$tickets = $ticketsDB->getAdvertizerTickets($_SESSION['advertizer_id']);


if (isset($_GET['confirm'])) {
    $ticketsDB->confirmTicket($_GET['confirm']);
    header("Location: admin_tickets.php");
    return;
}

?>
<div class=" container row  d-flex flex-grow-1 ">

        <div class="col-3 text-center">
            <div class="mt-4 ">
                <a href="admin_index.php" class="btn btn-lg btn-outline-secondary"> Zpět</a>
            </div>
        </div>
        <div class="col-9 my-4 ">

            <h1 class="mb-1">Vstupenky k potvrzení</h1>
            <?php foreach ($tickets as $ticket) : ?>
                <div>
                    <div class=" card mb-3">
                        <div class="card-body ">
                            <div class="d-flex flex-grow-1  justify-content-between">

                                <div>
                                    <h4 class="mb-0"><?php echo $ticket['name']; ?></h4>
                                    <p class="card-text">
                                        <small class="text-muted"><?php echo formatDateTimestamp($ticket['time']); ?></small>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <?php if (!isset($ticket['cancelled'])): ?>
                            <div class="card-footer d-flex align-items-center justify-content-between ">
                                <a class="btn btn-outline-primary rounded"
                                   href="admin_create_event.php?id=<?php echo $ticket['event_id']; ?>">Informace</a>

                                <a class="btn btn-warning rounded ml-2"
                                   href="admin_tickets.php?confirm=<?php echo $ticket['id']; ?>">Potvrdit
                                    platbu</a>
                            </div>
                        <?php endif; ?>

                    </div>

                </div>
            <?php endforeach; ?>


        </div>
    </div>

