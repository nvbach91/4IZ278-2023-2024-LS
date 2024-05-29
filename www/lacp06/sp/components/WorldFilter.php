<?php

require_once '../db/database_class.php';

$worldsDB = new WorldsDB();
$worlds = $worldsDB->findAll();
?>

<select id="world" name="world" class="form-select comic-select" aria-label="Default select example">
  <option selected>Svět</option>
  <?php foreach ($worlds as $world) : ?>
    <option value="<?php echo $world['id']; ?>" <?php echo isset($_SESSION['world']) && $_SESSION['world'] == $world['id'] ? 'selected' : '' ?>>
      <?php echo $world['name']; ?>
    </option>
  <?php endforeach; ?>
</select>