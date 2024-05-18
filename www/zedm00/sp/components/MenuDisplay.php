<?php

$types = ["divadlo", "koncert", "vystava", "festival", "prednaska"];

?>

<div class="list-group">
    <?php foreach ($types as $type) { ?>
        <a class="list-group-item" href="?category_id=<?php echo $type; ?>"><?php echo $type; ?></a>
    <?php } ?>
</div>