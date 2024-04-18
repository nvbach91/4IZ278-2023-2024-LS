<?php

require_once __DIR__ . '/../db/SlidesDB.php';

$slidesDb = new SlidesDB();
$slides = $slidesDb->find();

?>

<div class="carousel slide my-4" id="carouselExampleIndicators" data-ride="carousel">
	<ol class="carousel-indicators">
		<?php foreach ($slides as $id => $slide): ?>
		<?php $maybeActiveClass = $id === array_key_first($slides) ? 'active' : ''; ?>
		<li class="<?php echo $maybeActiveClass ?>" data-target="#carouselExampleIndicators" data-slide-to="<?php echo $id ?>"></li>
		<?php endforeach; ?>
	</ol>
	<div class="carousel-inner" role="listbox">
		<?php foreach ($slides as $id => $slide): ?>
		<?php $maybeActiveClass = $id === array_key_first($slides) ? 'active' : ''; ?>
		<div class="carousel-item <?php echo $maybeActiveClass ?>">
			<img class="d-block img-slides" src="<?php echo $slide['img'] ?>" alt="<?php echo $slide['title'] ?>" />
		</div>
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
