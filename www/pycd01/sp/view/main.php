<?php
include '../controller/prepareOffersMain.php';
include '../controller/themeSession.php';
?>

<?php require __DIR__ . '/incl/header.php'; ?>
<?php require __DIR__ . '/incl/navbar.php'; ?>
<main>
<div class="errors">
	<?php foreach($errors as $error): ?>
		<p><?= $error ?></p>
	<?php endforeach; ?>
</div>
    <div class="search-container">
	<form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
		<input name="searchByText" type="text" placeholder="Vyhledat...">
	</form>
        <button id="filterModal-switch" data-bs-toggle="modal" data-bs-target="#filterModal"><img src="../assets/filter.svg" alt="Filter"></button>
    </div>
    <div class="cards">
        <?php foreach ($offers as $offer): ?>
            <div class="card">
                <div>
                    <img src="<?= $offer['imageURL'] ?>" alt="obrázek nabídky">
                    <h4><?= $offer['address'] ?></h4>
                    <h5><?= $offer['priceString'] ?></h5>
                    <h6><?= $offer['typeString'] ?></h6>
                    <p>velikost: <?= $offer['rooms'] ?>, <?= $offer['size'] ?>m²</p>
                </div>
                <div>
                <div class="tags">
                        <?php foreach ($tags as $tag):
                            if ($tag['home_id'] == $offer['id']): ?>
                                <div class="tag" style="border: 2px solid <?= $tag['color'] ?>;);"><?= $tag['tag'] ?></div>
                        <?php endif;
                        endforeach; ?>
                    </div>
			    <a href="./offer.php?id=<?= $offer['id'] ?>"><button id="primary-button">Zobrazit nabídku</button></a>
                </div>
            </div>
	<?php endforeach; ?>
	<?php if(empty($offers)): ?>
		<h1>Vypadá to, že nejsou žádné nabídky vyhovující Vašim požadavkům.</h1>
		<h2>Zkuste to znovu s jinými filtry.</h2>
	<?php endif; ?>
    </div>
</main>
<?php require '../view/filterModal.php'; ?>
<?php require __DIR__ . '/incl/footer.php'; ?>
