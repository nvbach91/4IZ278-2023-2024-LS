<?php

require_once './db/database_class.php';
$publishersDB = new PublishersDB();
$publishers = $publishersDB->findAll();
?>

<select class="form-select comic-select" aria-label="Default select example">
  <option selected>Nakladatelství</option>
  <?php foreach ($publishers as $publisher) : ?>
    <option value="<?= $publisher['id'] ?>"><?= $publisher['name'] ?></option>
  <?php endforeach; ?>
</select>