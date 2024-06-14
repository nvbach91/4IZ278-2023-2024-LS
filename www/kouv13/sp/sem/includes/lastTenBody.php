<?php
require_once __DIR__ . '../../config.php';
include BASE_PATH . '/includes/authAdmin.php';
require_once BASE_PATH . '/includes/incl.php';


$reservations = $reservation->getLastTen();
?>
<h2 class="p-0 my-4">Poslední rezervace</h2>
<table class="table table-stripped table-hover" id="next">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Hala</th>
            <th scope="col">Sport</th>
            <th scope="col">Jméno</th>
            <th scope="col">Datum</th>
            <th scope="col">Čas</th>
            <th scope="col">Cena</th>
        </tr>
    </thead>
    <?php $actions->getLastTen($reservations); ?>

</table>
<div class="col mt-3">
    <button class="btn btn-success" type="button" onclick="getNextRes();">
        Další rezervace
    </button>
</div>