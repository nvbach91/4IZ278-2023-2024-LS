<?php
include '../controller/PrepareOffer.php';
include '../controller/themeSession.php';
?>
<?php require __DIR__ . '/incl/header.php'; ?>
<?php require __DIR__ . '/incl/navbar.php'; ?>
<section class="offer">
<br>
<a href="./main.php"><button id="secondary-button">Zpět</button></a>
<img src="<?= $offer['imageURL'] ?>" alt="Obrázek nabídky">
<div class="info-container">
    <div class="offer-info">
	<h4><?= $offer['address'] ?></h4>
        <h5><?= $offer['priceString'] ?></h5>
        <h6><?= $offer['typeString'] ?></h6>
	<p>velikost: <?= $offer['rooms'] ?>, <?= $offer['size'] ?>m²</p>
	<?php if($offer['garage_spaces'] != null && $offer['garage_spaces'] != 0): ?>
		<p>Počet parkovacích míst: <?= $offer['garage_spaces'] ?></p>
	<?php endif; ?>
	<?php if($offer['level'] != null): ?>
		<p>Patro: <?= $offer['level'] ?> </p>
	<?php endif; ?>
    	<div class="tags">
    	<?php foreach ($tags as $tag): ?>
	<?php if($tag['home_id'] == $offer['id']): ?>
		<div class="tag" style="border: 2px solid <?= $tag['color'] ?>;);"><?= $tag['tag'] ?></div>
	<?php endif; 
	endforeach; ?>
    	</div>
    
    </div>
    <div class="agency-info">
	<p>Realitní kancelář: <?= $agency['name'] ?></p>
    	<p>Zahájení prodeje: <?= $offer['time_offered'] ?></p>
    	<p>tel. č.: <?= $agency['phone'] ?></p>
	<p>e-mail: <?= $agency['email'] ?></p>
	<button id="primary-button">Mám zájem</button>
	<button id="primary-button">Už nemám zájem</button>
	<hr>
    	<button id="primary-button">Kontaktovat kancelář</button>
    </div>
</div>
</section>
<?php require __DIR__ . '/incl/footer.php'; ?>
