<?php
require __DIR__ . DIRECTORY_SEPARATOR . "utils" . DIRECTORY_SEPARATOR . "utils.php";
$action = $_SERVER['PHP_SELF'];

if (isset($_GET['email'])) {
  $successMessage = "Successfully registered!";
  $registered_email = $_GET['email'];
} else {
  $registered_email = "";
}

if (!empty($_POST)) {
  $email = htmlspecialchars(trim($_POST['email']));
  $password = htmlspecialchars(trim($_POST['password']));

  $errors = [];
  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    empty($email) ? $email_check = "Email is required!" : $email_check = $email . " is not a valid email adress!";
    array_push($errors, $email_check);
  }

  if (!empty($password)) {
    $user_validation = authenticate($email, $password, "./users.db");
    if ($user_validation !== true) {
      array_push($errors, $user_validation);
    }
  } else {
    array_push($errors, "Password is required!");
  }

  if (count($errors) == 0) {
    $successMessage = "Successfully logged in!";
  }
}

?>
<?php include "./includes/header.php"; ?>
<div class="container base">
  <h1>Log in</h1>
  <?php if (!empty($errors)) : ?>
    <div class="alert alert-danger">
      <?php foreach ($errors as $error) : ?>
        <p><?php echo $error; ?></p>
      <?php endforeach; ?>
    </div>
  <?php endif; ?>
  <?php if (isset($successMessage)) : ?>
    <div class="alert alert-success" role="alert">
      <p><?php echo $successMessage; ?></p>
    </div>
  <?php endif; ?>
  <form class="form-signup" method="post" action="<?php echo $action; ?>">
    <div class="form-group">
      <label>Email</label>
      <input class="form-control" name="email" value="<?php echo $registered_email ?>">
    </div>
    <div class="form-group">
      <label>Password</label>
      <input type="password" class="form-control" name="password">
    </div>
    <button class="btn btn-primary" type="submit">Sign in</button>
  </form>
</div>
<?php include "./includes/footer.php"; ?>