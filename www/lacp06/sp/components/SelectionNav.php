<?php

require_once '../utils/absolute-path.php';

?>
<nav class="navbar navbar-expand-lg navbar-dark">
  <div class="container">
    <button class="selection-button" type="button" data-toggle="collapse" data-target="#navbarResponsive2" aria-controls="navbarResponsive2" aria-expanded="false" aria-label="Toggle navigation">MENU</button>
    <div class="collapse navbar-collapse" id="navbarResponsive2">
      <div class="selection-bar">
        <div class="selection-bar-item"><a href="<?php echo $absolutePath; ?>routes/worlds.php">SVĚTY</a></div>
        <div class="selection-bar-item"><a href="<?php echo $absolutePath; ?>routes/genres.php">ŽÁNRY</a></div>
        <div class="selection-bar-item"><a href="<?php echo $absolutePath; ?>routes/publishers.php">NAKLADATELSTVÍ</a></div>
        <div class="selection-bar-item"><a href="<?php echo $absolutePath; ?>routes/filtered.php/?new_release">NOVINKY</a></div>
        <?php if (isset($_COOKIE['name'])) : ?>
          <div class="selection-bar-item"><a href="<?php echo $absolutePath; ?>routes/filtered.php/?for_me">PRO MĚ</a></div>
        <?php endif; ?>
      </div>
    </div>
  </div>
</nav>