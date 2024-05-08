<div class="modal" id="filterModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog left-aligned-modal">
    <div class="modal-content">
      <div class="modal-header">
	<form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
	  	<button type="submit" id="primary-button" data-bs-dismiss="modal">Zrušit filtr</button>
  	</form>
        <h1 class="modal-title fs-5" id="exampleModalLabel">Filtr nabídek bydlení</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
        <div class="modal-body radio-container">
          <div>Typ bydlení
	  <div class="homeTypeContainer">
	    <input type="radio" name="homeType" id="apartment" value="apartment" checked>
            <label for="apartment">
              <div class="homeTypeSelect">Byt</div>
            </label>
            <input type="radio" name="homeType" id="house" value="house">
            <label for="house">
              <div class="homeTypeSelect">Dům</div>
            </label>
            </div>
	</div>
          <div>Typ nabídky
          <div class="homeTypeContainer">
            <input type="radio" name="offerType" id="rent" value="rent" checked>
            <label for="rent">
              <div class="homeTypeSelect">Nájem</div>
            </label>
            <input type="radio" name="offerType" id="buy" value="buy">
            <label for="buy">
              <div class="homeTypeSelect">Koupě</div>
            </label>
	  </div>
	</div>
	<label>Cena(kč)
            <div class="input-group">
              <input name="minPrice" type="number" aria-label="Minimální cena" class="form-control" placeholder="Minimální cena">
              <input name="maxPrice" type="number" aria-label="Maximální cena" class="form-control" placeholder="Maximální cena">
            </div>
          </label>
          <label>Velikost(m²)
            <div class="input-group">
              <input name="minSize" type="number" aria-label="Minimální velikost" class="form-control" placeholder="Minimální velikost">
              <input name="maxSize" type="number" aria-label="Maximální velikost" class="form-control" placeholder="Maximální velikost">
            </div>
          </label>
          <div>Značky
            <div class="tags">
              <?php foreach ($tagsforModal as $tag): ?>
                <input type="radio" name="tag" id="<?= $tag['id'] ?>" value="<?= $tag['tag'] ?>">
                <label for="<?= $tag['id'] ?>">
                  <div class="tag" style="border: 2px solid <?= $tag['color'] ?>;);"><?= $tag['tag'] ?></div>
                </label>
              <?php endforeach; ?>
            </div>
          </div>
        </div>
        
	<div class="modal-footer">
 	
          <button type="submit" id="primary-button">Zobrazit položky</button>
        </div>
      </form>
    </div>
  </div>
</div>
