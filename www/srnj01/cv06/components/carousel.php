<?php
require_once('db/eshop.php');
$db = new CarouselDB();
$carousel = $db->find();
?>

<div class="carousel slide my-4" id="carouselExampleIndicators" data-ride="carousel">
  <ol class="carousel-indicators">
    <li class="active" data-target="#carouselExampleIndicators" data-slide-to="0"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
  </ol>
  <div class="carousel-inner" role="listbox">
    <?php foreach ($carousel as $slide) { ?>
      <div class="carousel-item <?php echo $slide['id'] === 1 ? 'active' : '' ?>">
        <img class="d-block img-fluid img-carousel" src="<?php echo $slide['image']; ?>" alt="<?php echo $slide['title']; ?>" />
      </div>
    <?php } ?>
  </div>
  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>