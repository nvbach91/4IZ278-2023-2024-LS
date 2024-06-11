<div class="col-12 my-3">
    <div class="row justify-content-center">
        <div class="col text-end normal-text"><button class="btn btn-success arrows" <?php if ($previous < $thisWeekMonday) {
                                                                                            echo ' disabled ';
                                                                                        } ?>onclick="loadCalendar('<?php echo $previous; ?>');">
                < </button>
        </div>
        <div class="col">
            <h3 class="text-center" id="week"><?php echo $monday . ' - ' . $sunday; ?></h3>
        </div>
        <div class="col normal-text">
            <button class="btn btn-success arrows" <?php if ($next > $sunday_next_next_week && !isset($_SESSION['admin'])) {
                                                        echo ' disabled ';
                                                    } ?> onclick="loadCalendar('<?php echo $next; ?>');">
                > </button>
        </div>
    </div>
    <div class="row justify-content-center mt-2">
        <div class="col">
            <span class="indicator bg-white"></span>
            <span class="me-2">Volné</span>
            <span class="indicator bg-success"></span>
            <span class="me-2">Tvoje termíny</span>
            <span class="indicator bg-danger"></span>
            <span class="me-2">Plné</span>
            <span class="indicator bg-primary"></span>
            <span class="me-2">Vybrané</span>
            <span class="indicator bg-dark"></span>
            <span>Nelze zarezervovat</span>
        </div>

    </div>
</div>
<div class="col-12">
    <div class="row justify-content-center small-text align-items-center mb-2">
        <div class="col normal-text">Den</div>
        <?php $reservation->getTimes(); ?>
    </div>
    <?php $reservation->getTable($weekRange, $reserved); ?>
</div>
<form action="/~kouv13/sem/includes/reservation/confirmReservation.php" method="post" id="hidden-form">
    <input type="hidden" name="monday" value="<?php echo $m; ?>">
</form>