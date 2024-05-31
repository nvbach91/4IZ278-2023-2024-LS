<?php

if (isset($_SESSION['order'])) {
  $order = $_SESSION['order'];
} else {
  $order = 'date_asc';
}
?>

<select id="order" name="order" class="form-select comic-select">
  <option value="date_asc" <?php echo $order == 'date_asc' ?  'selected' : '' ?>>Nejnovější</option>
  <option value="date_desc" <?php echo $order == 'date_desc' ?  'selected' : '' ?>>Nejstarší</option>
  <option value="price_asc" <?php echo $order == 'price_asc' ?  'selected' : '' ?>>Od nejlevnějšího</option>
  <option value="price_desc" <?php echo $order == 'price_desc' ?  'selected' : '' ?>>Od nejdražšího</option>
  <option value="name_asc" <?php echo $order == 'name_asc' ?  'selected' : '' ?>>Abecedně</option>
  <option value="rating_order" <?php echo $order == 'rating_order' ?  'selected' : '' ?>>Hodnocení</option>
  <option value="not_published" <?php echo $order == 'not_published' ?  'selected' : '' ?>>Nepublikováno</option>
</select>