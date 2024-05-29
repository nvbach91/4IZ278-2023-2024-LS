<?php

require_once '../db/database_class.php';

$genresDB = new GenresDB();
$genres = $genresDB->findAll();
?>

<select id="genre" name="genre" class="form-select comic-select" aria-label="Default select example">
  <option>Žánr</option>
  <?php foreach ($genres as $genre) : ?>
    <option value="<?php echo $genre['id']; ?>" <?php echo isset($_SESSION['genre']) && $_SESSION['genre'] == $genre['id'] ? 'selected' : '' ?>>
      <?php echo $genre['name']; ?>
    </option>
  <?php endforeach; ?>
</select>