<?php

require_once '../db/database_class.php';
require_once '../utils/check-privileges.php';
require_once '../utils/absolute-path.php';

$genresDB = new GenresDB();

$genres = $genresDB->findAll();
?>
<?php require '../components/Header.php'; ?>
<?php require '../components/SelectionNav.php'; ?>
<div class="comic-container">
  <div class="comic-headline">
    <h1>Žánry</h1>
  </div>
  <div class="comic-print">
    <?php if ($privileges > 2) : ?>
      <div class="admin-button">
        <a href="<?php echo $absolutePath; ?>routes/admin_genre.php">
          <button class="btn btn-secondary">Přidat žánr</button>
        </a>
      </div>
    <?php endif; ?>
    <?php foreach ($genres as $genre) : ?>
      <div class="filter-item">
        <div class="filter-image">
          <img src="<?php echo $genre['image']; ?>" alt="world">
        </div>
        <div class="filter-details">
          <p class="name"><?php echo $genre['name']; ?></p>
          <p class="description"><?php echo $genre['description']; ?></p>
          <div class="actions">
            <?php if ($privileges > 2) : ?>
              <a href="<?php echo $absolutePath; ?>routes/edit_genre.php/?genre_id=<?php echo $genre['id']; ?>">
                <button class="btn btn-danger">Editovat</button>
              </a>
            <?php endif; ?>
            <a href="<?php echo $absolutePath; ?>routes/filtered.php/?genre_id=<?php echo $genre['id']; ?>">
              <button class="btn btn-danger">Zobrazit</button>
            </a>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</div>
<?php require '../components/Footer.php'; ?>