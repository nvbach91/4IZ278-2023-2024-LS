<?php
require_once './db/database_eshop.php';

$productsDB = new ProductsDB();
$action = $_SERVER['PHP_SELF'];

if (!empty($_POST)) {
  $username = htmlspecialchars(trim($_POST['username']));
  $password = htmlspecialchars(trim($_POST['password']));

  $errors = [];
  if (empty($username)) {
    array_push($errors, "Username is required!");
  }

  if (empty($password)) {
    array_push($errors, "Password is required!");
  }

  if (count($errors) == 0) {
    setcookie("name", $username, time() + 3600, "/");
    header("Location: /www/lacp06/cv08/index.php");
  }
}

?>

<?php require __DIR__ . '/includes/Header.php'; ?>
<div class="container">
  <form action="<?php echo $action ?>" method="POST" style="display: flex; flex-direction: column; height: 600px; justify-content: center;">
    <?php if (!empty($errors)) : ?>
      <div class="alert alert-danger">
        <?php foreach ($errors as $error) : ?>
          <p><?php echo $error; ?></p>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>
    <input type="username" name="username" class="form-control" placeholder="Username">
    <input type="password" name="password" class="form-control" placeholder="Password">
    <button type="submit" class="btn btn-primary">Login</button>
  </form>
</div>
<div style="position: absolute; bottom: 0; width: 100%;">
  <?php require __DIR__ . '/includes/Footer.php'; ?>
</div>