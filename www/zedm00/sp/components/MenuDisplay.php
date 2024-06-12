<?php
require_once './config/config.php';
?>

<div class="list-group">
    <?php foreach (TYPES as $type) { ?>
        <a class="list-group-item" href="customer_index.php?category_id=<?php echo $type['key']; ?>"><?php echo $type['translation']; ?></a>
    <?php } ?>
</div>
