<?php

require 'classes/SlidesDB.php';
$slidesDB = new SlidesDB();
$slides = $slidesDB->find();

?>

<ol class="carousel-indicators">
    <li class="active" data-target="#carouselExampleIndicators" data-slide-to="0"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
</ol>
<div class="carousel-inner" role="listbox">
    <div class="carousel-item active"><img class="d-block img-fluid" src="<?php echo $slides[0]['img']; ?>" alt="<?php echo $slides[0]['title']; ?>" /></div>
    <div class="carousel-item"><img class="d-block img-fluid" src="<?php echo $slides[1]['img']; ?>" alt="<?php echo $slides[1]['title']; ?>" /></div>
    <div class="carousel-item"><img class="d-block img-fluid" src="<?php echo $slides[2]['img']; ?>" alt="<?php echo $slides[2]['title']; ?>" /></div>
</div>
<a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
</a>
<a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
</a>