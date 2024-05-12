<?php

require_once './db/database_class.php';
$genresDB = new GenresDB();
$genres = $genresDB->findAll();
?>

<select class="form-select comic-select" aria-label="Default select example">
  <option selected>Žánr</option>
  <?php foreach ($genres as $genre) : ?>
    <option value="<?= $genre['id'] ?>"><?= $genre['name'] ?></option>
  <?php endforeach; ?>
</select>