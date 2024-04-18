<?php
if (!isset($_SESSION)) {
  session_start();
}
if (!isset($_SESSION['username'])) {
  header('Location: login.php');
}

include('includes/header.php');
?>

<div class="row">
  <div class="col-lg-12">
    <h1 class="my-4">Welcome, <?php echo $_SESSION['username']; ?></h1>
    <p>This is a protected page. You can only see this content if you are logged in.</p>
    <p>You can view your cart <a href="cart.php">here</a>.</p>
    <p>You can add a new product <a href="add.php">here</a>.</p>
  </div>
</div>

<?php
include('includes/footer.php');
?>