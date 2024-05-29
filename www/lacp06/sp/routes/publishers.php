<?php

require_once '../db/database_class.php';
require_once '../utils/check-privileges.php';

$publishersDB = new PublishersDB();

$publishers = $publishersDB->findAll();
?>
<?php require '../components/Header.php'; ?>
<?php require '../components/SelectionNav.php'; ?>
<div class="comic-container">
  <div class="comic-headline">
    <h1>Nakladatelsví</h1>
  </div>
  <div class="comic-print">
    <?php if ($privileges > 2) : ?>
      <div class="admin-button">
        <a href="<?php echo $absolutePath; ?>routes/admin_publisher.php">
          <button class="btn btn-secondary">Přidat nakladatelství</button>
        </a>
      </div>
    <?php endif; ?>
    <?php foreach ($publishers as $publisher) : ?>
      <div class="filter-item">
        <div class="filter-image">
          <img src="<?php echo $publisher['image']; ?>" alt="world">
        </div>
        <div class="filter-details">
          <p class="name"><?php echo $publisher['name']; ?></p>
          <p class="description"><?php echo $publisher['description']; ?></p>
          <div class="actions">
            <?php if ($privileges > 2) : ?>
              <a href="<?php echo $absolutePath; ?>routes/edit_publisher.php/?publisher_id=<?php echo $publisher['id']; ?>">
                <button class="btn btn-danger">Editovat</button>
              </a>
            <?php endif; ?>
            <a href="<?php echo $absolutePath; ?>routes/filtered.php/?publisher_id=<?php echo $publisher['id']; ?>">
              <button class="btn btn-danger">Zobrazit</button>
            </a>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</div>
<?php require '../components/Footer.php'; ?>