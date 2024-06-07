<?php session_status() === PHP_SESSION_NONE ? session_start() : null; ?>


<?php if (!empty($errors)) : ?>

    <div class="alert alert-danger" role="alert">
        <strong>Vyskytly se následující chyby:</strong>
        <?php foreach ($errors as $e) : ?>
            <div><?php echo $e ?></div>
        <?php endforeach ?>
    </div>
    <br>
<?php endif ?>