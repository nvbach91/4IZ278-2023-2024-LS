<?php
require_once __DIR__ . '../../config.php';
include BASE_PATH . '/includes/authAdmin.php';
?>

<div class="row p-0 mb-3">
    <div class="col m-0 p-0">
        <button class="btn btn-success" type="button" data-bs-toggle="collapse" data-bs-target="#today" aria-expanded="false" aria-controls="today">
            Dnešní rezervace
        </button>
        <button class="btn btn-success" type="button" data-bs-toggle="collapse" data-bs-target="#lastten" aria-expanded="false" aria-controls="lastten">
            Poslední rezervace
        </button>
    </div>
</div>


<div class="collapse p-0 mb-3" id="today">
    <div class="card card-body">
        <?php include BASE_PATH . '/includes/todayReservationsBody.php'; ?>
    </div>
</div>
<div class="collapse p-0 mb-3" id="lastten">
    <div class="card card-body">
        <?php include BASE_PATH . '/includes/lastTenBody.php'; ?>
    </div>
</div>