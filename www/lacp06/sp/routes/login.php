<?php
require_once '../db/database_class.php';
require_once '../utils/google-config.php';

$usersDB = new UsersDB();
$action = $_SERVER['PHP_SELF'];

if (!empty($_POST)) {
  $email = htmlspecialchars(trim($_POST['email']));
  $password = htmlspecialchars(trim($_POST['password']));

  $errors = [];
  $user = $usersDB->findUser($email);

  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    empty($email) ? $email_check = "Email je povinný!" : $email_check = $email . " není validní emailová adresa!";
    array_push($errors, $email_check);
  } else {
    if (empty($user)) {
      array_push($errors, "Uživatel nenalezen!");
    } else {

      if (!empty($password)) {
        $user_validation = password_verify($password, $user[0]['password']);
        if (!$user_validation) {
          array_push($errors, "Nesprávné heslo!");
        }
      } else {
        array_push($errors, "Heslo je povinné!");
      }
    }
  }

  if (count($errors) == 0) {
    setcookie("name", $email, time() + 3600, "/");
    header("Location: /www/lacp06/sp/routes/index.php");
  }
}

?>

<?php require '../components/Header.php'; ?>
<div class="container">
  <form class="comic-login" action="<?php echo $action ?>" method="POST" style="display: flex; flex-direction: column; height: 600px; justify-content: center;">
    <?php if (!empty($errors)) : ?>
      <div class="alert alert-danger">
        <?php foreach ($errors as $error) : ?>
          <p><?php echo $error; ?></p>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>
    <input type="email" name="email" class="form-control" placeholder="Email">
    <input type="password" name="password" class="form-control" placeholder="Heslo">
    <button type="submit" class="btn btn-danger">Přihlásit</button>
    <a href="<?php echo $client->createAuthUrl(); ?>">
      <button type="button" class="login-with-google-btn">Přihlásit přes Google</button>
    </a>
  </form>
</div>
<div style="position: absolute; bottom: 0; width: 100%;">
  <?php require '../components/Footer.php'; ?>
</div>