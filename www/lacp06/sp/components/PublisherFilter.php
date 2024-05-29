<?php

require_once '../db/database_class.php';

$publishersDB = new PublishersDB();
$publishers = $publishersDB->findAll();
?>

<select id="publisher" name="publisher" class="form-select comic-select" aria-label="Default select example">
  <option selected>Nakladatelství</option>
  <?php foreach ($publishers as $publisher) : ?>
    <option value="<?php echo $publisher['id']; ?>" <?php echo isset($_SESSION['publisher']) && $_SESSION['publisher'] == $publisher['id'] ? 'selected' : '' ?>>
      <?php echo $publisher['name']; ?>
    </option>
  <?php endforeach; ?>
</select>