<?php
include "./classes/Users.php";
session_start();
$users = new UsersDB();
if (!isset($_COOKIE["email"]) && $_COOKIE['privilege'] < 2) {
  header('Location: ./main.php');
}
if (!empty($_POST)) {
  $_POST['privilege'] = (string) $_POST['privilege'];
  $_POST['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
  $users->create($_POST);
  header("Location: main.php");
  exit();
}
?>
<?php require __DIR__ . '/incl/header.php'; ?>
<?php require __DIR__ . '/incl/navbar.php'; ?>
<main class="container">
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
  <div class="form-group">
    <label >Email
        <input name="email" class="form-control" placeholder="Enter email">
    </label>
  </div>
  <br>
  <div class="form-group">
    <label >Password
        <input name="password" class="form-control" placeholder="Enter password">
    </label>
  </div>
  <br>
  <div class="form-group">
    <label >Name
        <input name="name" class="form-control" placeholder="Enter name">
    </label>
  </div>
  <br>
  <div class="form-group">
    <label >Privilege
        <input name="privilege" type="number" class="form-control" placeholder="Enter privilege">
    </label>
  </div>
  <br>
  <button type="submit" class="btn btn-primary">Submit</button>
  <a href="./main.php"><button type="button" class="btn btn-secondary">Back</button></a>
</form>
</main>
<?php require __DIR__ . '/incl/footer.php'; ?>