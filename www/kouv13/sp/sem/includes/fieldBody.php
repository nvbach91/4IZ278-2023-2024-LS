<div class="col-12 p-0 mb-2">
    <h2><?php echo $f->name; ?></h2>
    <p><?php echo $f->description; ?></p>
    <p>Jednotková cena: <span id="annual-price"><?php echo $f->price; ?></span> Kč, Kapacita:
        <?php echo $f->capacity; ?> osob</p>
</div>
<?php include BASE_PATH . '/includes/logs.php'; ?>
<div class="d-flex flex-column p-0 mb-5">
    <div class="list-group list-group-radio d-flex flex-row m-0">
        <?php $actions->getSports($idfield); ?>
    </div>
</div>
<div class="col-12 bg-grey rounded-3 px-4 py-2">
    <div class="row" id="calendar">
        <?php $actions->getCalendar(date('Y-m-d')); ?>
    </div>
</div>