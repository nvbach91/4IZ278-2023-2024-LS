<?php require_once __DIR__ . './../db/EventsDB.php'; ?>
<?php
$eventsDB = new EventsDB;

define('GLOBAL_CURRENCY', 'USD');

$events = $eventsDB->getEvents();

echo count($events);


?>
<div class="row">
  
  <?php foreach ($events as $event) : ?>
    <div class="col-lg-4 col-md-6 mb-4">
      <div class="card h-100 product">
        <a href="#">
          <img class="card-img-top product-image" src="<?php echo $event['img']; ?>" alt="mango-product-image">
        </a>
        <div class="card-body">
          <h4 class="card-title">
            <a href="#"><?php echo $event['name']; ?></a>
          </h4>

          <h5><?php echo number_format($event['price'], 2), ' ', GLOBAL_CURRENCY; ?></h5>
          <p class="card-text">...</p>
        </div>
        <div class="card-footer">
          <small class="text-muted">&#9733; &#9733; &#9733; &#9733; &#9734;</small>
        </div>
      </div>
    </div>
  <?php endforeach; ?>
</div>