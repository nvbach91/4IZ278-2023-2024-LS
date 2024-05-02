<?php
require_once './db/database_eshop.php';

$usersDB = new UsersDB();
$action = $_SERVER['PHP_SELF'];

if (!empty($_POST)) {
  $email = htmlspecialchars(trim($_POST['email']));
  $password = htmlspecialchars(trim($_POST['password']));

  $errors = [];
  $user = $usersDB->findUser($email);

  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    empty($email) ? $email_check = "Email is required!" : $email_check = $email . " is not a valid email adress!";
    array_push($errors, $email_check);
  } else {
    if (empty($user)) {
      array_push($errors, "User not found!");
    } else {
      if (!empty($password)) {
        $user_validation = password_verify($password, $user['password']);
        if (!$user_validation) {
          array_push($errors, "Invalid password!");
        }
      } else {
        array_push($errors, "Password is required!");
      }
    }
  }

  if (count($errors) == 0) {
    setcookie("name", $email, time() + 3600, "/");
    header("Location: /www/lacp06/cv10/index.php");
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
    <input type="email" name="email" class="form-control" placeholder="Email">
    <input type="password" name="password" class="form-control" placeholder="Password">
    <button type="submit" class="btn btn-primary">Login</button>
  </form>
</div>
<div style="position: absolute; bottom: 0; width: 100%;">
  <?php require __DIR__ . '/includes/Footer.php'; ?>
</div>