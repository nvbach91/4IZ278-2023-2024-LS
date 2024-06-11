<?php
require_once __DIR__ . '../../config.php';
include BASE_PATH . '/includes/authAdmin.php';
require_once BASE_PATH . '/includes/reservation/reservation.class.php';
$reservation = new reservation();
?>
<h2 class="p-0 my-4">Dnešní rezervace</h2>
<table class="table table-stripped table-hover">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Hala</th>
            <th scope="col">Sport</th>
            <th scope="col">Jméno</th>
            <th scope="col">Čas</th>
            <th scope="col">Cena</th>
        </tr>
    </thead>
    <?php $reservation->getTodayReservations(); ?>

</table>