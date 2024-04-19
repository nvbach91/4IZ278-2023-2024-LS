<?php
if (isset($_POST['username'])) {
  if (!isset($_SESSION)) {
    session_start();
  }
  $_SESSION['username'] = $_POST['username'];
  header('Location: index.php?login=success');
}

include('includes/header.php');
?>

<div class="row">
  <div class="col-lg-12">
    <h1 class="my-4">Log In</h1>
    <form action="login.php" method="post">
      <div class="form-group">
        <label for="username">Username</label>
        <input type="text" class="form-control" id="username" name="username" aria-describedby="username" placeholder="Your username">
      </div>
      <button type="submit" class="btn btn-primary">Submit</button>
    </form>
  </div>
</div>

<?php
include('includes/footer.php');
?>