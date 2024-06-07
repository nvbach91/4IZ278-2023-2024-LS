<?php session_status() === PHP_SESSION_NONE ? session_start() : null; ?>
<?php require "./logic/display-errors.php" ?>

<?php $pageName = "Nemáš přístup" ?>


<?php include "./inc/head.php" ?>
<div style="display: flex; justify-content: center; align-items: center; flex-direction: column; padding-top: 50px">
    <h1>K této stránce nemáš přístup</h1>
    <br>
    <a href="index.php" class="btn btn-primary">Zpět na domovskou obrazovku</a>
</div>
<?php include "./inc/foot.php" ?>