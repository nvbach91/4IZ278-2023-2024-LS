<?php

require_once '../db/database_class.php';
require_once '../utils/check-privileges.php';
require_once '../utils/absolute-path.php';

$worldsDB = new WorldsDB();

$worlds = $worldsDB->findAll();
?>
<?php require '../components/Header.php'; ?>
<?php require '../components/SelectionNav.php'; ?>
<div class="comic-container">
  <div class="comic-headline">
    <h1>Světy</h1>
  </div>
  <div class="comic-print">
    <?php if ($privileges > 2) : ?>
      <div class="admin-button">
        <a href="<?php echo $absolutePath; ?>routes/admin_world.php">
          <button class="btn btn-secondary">Přidat svět</button>
        </a>
      </div>
    <?php endif; ?>
    <?php foreach ($worlds as $world) : ?>
      <div class="filter-item">
        <div class="filter-image">
          <img src="<?php echo $world['image']; ?>" alt="world">
        </div>
        <div class="filter-details">
          <p class="name"><?php echo $world['name']; ?></p>
          <p class="description"><?php echo $world['description']; ?></p>
          <div class="actions">
            <?php if ($privileges > 2) : ?>
              <a href="<?php echo $absolutePath; ?>routes/edit_world.php/?world_id=<?php echo $world['id']; ?>">
                <button class="btn btn-danger">Editovat</button>
              </a>
            <?php endif; ?>
            <a href="<?php echo $absolutePath; ?>routes/filtered.php/?world_id=<?php echo $world['id']; ?>">
              <button class="btn btn-danger">Zobrazit</button>
            </a>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</div>
<?php require '../components/Footer.php'; ?>