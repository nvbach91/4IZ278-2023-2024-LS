<?php

require_once './db/database_eshop.php';
$slidesDB = new SlidesDB();
$slides = $slidesDB->find();

?>
<div class="carousel slide my-4" id="carouselExampleIndicators" data-ride="carousel">
  <ol class="carousel-indicators">
    <?php for ($i = 0; $i < count($slides); $i++) : ?>
      <?php $i == 1 ? $slide_active = 'class="active"' : $slide_active = ''; ?>
      <li <?php echo $slide_active ?> data-target="#carouselExampleIndicators" data-slide-to="<?php echo $i; ?>"></li>
    <?php endfor; ?>
  </ol>
  <div class="carousel-inner" role="listbox">
    <?php foreach ($slides as $slide) : ?>
      <?php $slide['slide_id'] == 1 ? $img_active = 'active' : $img_active = ''; ?>
      <div class="carousel-item <?php echo $img_active; ?>"><img class="d-block img-fluid" height="350" width="900" src="<?php echo $slide['img'] ?>" alt="<?php echo $slide['title'] ?>" /></div>
    <?php endforeach; ?>
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