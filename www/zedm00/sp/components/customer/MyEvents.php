<?php

require_once __DIR__ . './../../db/TicketsDB.php';
include __DIR__ . './../../utils.php';
$ticketsDB = new TicketsDB;


$tickets = $ticketsDB->getCustomerTickets($_SESSION['customer_id']);

?>

<div class="container my-4">
    <h1 class="mb-8">Moje vstupenky</h1>
    <?php foreach ($tickets as $ticket) : ?>
        <div>
            <div class=" card mb-3">
                <div class="card-body ">
                    <div class="d-flex align-items-center justify-content-between">

                        <div>
                            <h4 class="mb-0"><?php echo $ticket['name']; ?></h4>
                            <p class="card-text">
                                <small class="text-muted"><?php echo formatDateTimestamp($ticket['time']); ?></small>
                            </p>
                        </div>

                        <div>
                            <?php if ($ticket['cancelled']): ?>
                                <p class="alert alert-danger mb-0">Zrušeno</p>
                            <?php elseif ($ticket['confirmed']): ?>
                                <div class="text-center">
                                    <p class="alert alert-success mb-0">Potvrzeno </p>
                                    <small>kód vstupenky:<?php echo $ticket['code']; ?></small>
                                </div>
                            <?php else: ?>
                                <p class="alert alert-warning mb-0">Nepotvrzeno</p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <?php if (!$ticket['cancelled']): ?>
                    <div class="card-footer d-flex align-items-center ">
                        <a class="btn btn-outline-primary rounded"
                           href="event_detail.php?id=<?php echo $ticket['event_id']; ?>">Informace</a>
                        <?php if ($ticket['confirmed']): ?>
                            <!--                    todo: send to email logic -->
                            <button class="btn btn-outline-warning rounded ml-2">Poslat na e-mail</button>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>

            </div>

        </div>
    <?php endforeach; ?>
</div>



