<?php

require 'classes/SlidesDB.php';
$slidesDB = new SlidesDB();
$slides = $slidesDB->find();

?>

<ol class="carousel-indicators">
    <?php for ($i = 0; $i < count($slides); $i++) { ?>
        <li class="<?php echo ($i == 0) ? 'active' : '' ?>" data-target="#carouselExampleIndicators" data-slide-to="<?php echo $i; ?>"></li>
    <?php } ?>
</ol>

<div class="carousel-inner" role="listbox">
    <?php for ($i = 0; $i < count($slides); $i++) { ?>
        <div class="carousel-item <?php echo ($i == 0) ? 'active' : '' ?>"><img class="d-block img-fluid" src="<?php echo $slides[$i]['img']; ?>" alt="<?php echo $slides[$i]['title']; ?>" /></div>
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