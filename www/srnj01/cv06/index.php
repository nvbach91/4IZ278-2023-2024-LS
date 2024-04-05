<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

include('includes/header.php');
include('components/nav.php');

?>
<!-- Page Content-->
<div class="container">
  <div class="row">
    <div class="col-lg-3">
      <?php include('components/sidebar.php'); ?>
    </div>
    <div class="col-lg-9">
      <?php include('components/carousel.php'); ?>

      <?php include('components/products.php'); ?>
    </div>
  </div>
</div>

<?php
include('includes/footer.php');
?>

<?php require('../hotreloader.php') ?>