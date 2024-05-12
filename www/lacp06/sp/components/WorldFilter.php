<?php

require_once './db/database_class.php';
$worldsDB = new WorldsDB();
$worlds = $worldsDB->findAll();
?>

<select class="form-select comic-select" aria-label="Default select example">
  <option selected>Svět</option>
  <?php foreach ($worlds as $world) : ?>
    <option value="<?= $world['id'] ?>"><?= $world['name'] ?></option>
  <?php endforeach; ?>
</select>