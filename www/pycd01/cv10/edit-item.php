<?php
include "./classes/Users.php";



if (empty($_GET["id"])) {
  header("Location: main.php");
  exit();
}
$usersDB = new UsersDB();
$id = (int)$_GET['id'];
$u = $usersDB->read($id);
$u = $u[0];

if (!empty($_POST)) {
  $_POST['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
  $u['email'] = $_POST['email'];
  $u['name'] = $_POST['name'];
  if (!empty($_POST['password'])) {
    $u['password'] = $_POST['password'];
  }

  $usersDB->update($_POST, $id);
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
        <input name="email" class="form-control" placeholder="Enter email" value="<?= $u['email'] ?>">
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
        <input name="name" class="form-control" placeholder="Enter name" value="<?= $u['name'] ?>">
    </label>
  </div>
  <br>
  <button type="submit" class="btn btn-primary">Submit</button>
  <a href="./main.php"><button type="button" class="btn btn-secondary">Back</button></a>
</form>
</main>
<?php require __DIR__ . '/incl/footer.php'; ?>