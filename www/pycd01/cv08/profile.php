<?php
if (!isset($_COOKIE['name'])) {
    header('Location: login.php');
    exit();
 }
 $name = @$_COOKIE['name'];
?>

<?php require './incl/header.php'; ?>
   <?php include './incl/navbar.php'; ?>
   <main class="container">
      <h1>My Profile</h1>
      <h2>Name: <?= $name ?></h2>
   </main>
<?php require './incl/footer.php'; ?>