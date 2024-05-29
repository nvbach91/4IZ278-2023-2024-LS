<?php

require_once '../utils/user-check.php';
require_once '../db/database_class.php';

$usersDB = new UsersDB();
$action = $_SERVER['PHP_SELF'];
$user = $usersDB->findUser($_COOKIE['name']);

if (!empty($_POST)) {
  $email = !empty($_POST['email']) ? htmlspecialchars(trim($_POST['email'])) : NULL;
  $username = !empty($_POST['username']) ? htmlspecialchars(trim($_POST['username'])) : NULL;
  $password_old = !empty($_POST['password_old']) ? htmlspecialchars(trim($_POST['password_old'])) : NULL;
  $password_new = !empty($_POST['password_new']) ? htmlspecialchars(trim($_POST['password_new'])) : NULL;

  $errors = [];
  $changes = false;
  $user = $usersDB->findUser($email);
  $current_user = $usersDB->findUser($_COOKIE['name']);

  if (!empty($email)) {
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $email_check = $email . " není validní emailová adresa!";
      array_push($errors, $email_check);
    } else if (!empty($user)) {
      $email_check = "Uživatel již existuje!";
      array_push($errors, $email_check);
    }
    $changes = true;
  }

  if (!empty($password_old)) {
    $user_validation = password_verify($password_old, $current_user[0]['password']);
    if (!$user_validation) {
      array_push($errors, "Nesprávné heslo!");
    }
    $changes = true;
  }

  if (!empty($username)) {
    if (strlen($username) < 3) {
      array_push($errors, "Uživatelské jméno musí mít alespoň 3 znaky!");
    }
    $changes = true;
  }

  if (!empty($password_new)) {
    if (empty($password_old)) {
      array_push($errors, "Pro změnu hesla je potřeba zadat staré heslo!");
      $password_new = NULL;
    } else {
      if (strlen($password_new) < 8) {
        array_push($errors, "Nové heslo musí mít alespoň 8 znaků!");
      } else if ($password_old == $password_new) {
        array_push($errors, "Nové heslo nesmí být stejné jako staré!");
      } else {
        $password_new = password_hash($password_new, PASSWORD_DEFAULT);
      }
      $changes = true;
    }
  }

  if (count($errors) == 0 && $changes != false) {
    $successMessage = "Změny byly úspěšně provedeny!";
    $usersDB->updateUser($_COOKIE['name'], $email, $username, $password_new);
    if (!empty($email)) {
      header("Location: /www/lacp06/sp/routes/index.php");
      setcookie("name", $email, time() + 3600, "/");
    }
  }
}

?>

<?php require '../components/Header.php'; ?>
<div class="container">
  <form class="comic-profile" action="<?php echo $action ?>" method="POST">
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
    <h1>Uživatelské údaje</h1>
    <div class="info">
      <p>Email:</p>
      <p><?php echo $user[0]['email']; ?></p>
      <p>Uživatelské jméno:</p>
      <p><?php echo $user[0]['username']; ?></p>
    </div>
    <p style="margin: 0; font-weight: bold; font-size: 24px;">Změnit údaje</p>
    <?php if (empty($user[0]['token'])) : ?>
      <input type="email" name="email" class="form-control" placeholder="Email">
    <?php endif; ?>
    <input type="text" name="username" class="form-control" placeholder="Uživatelské jméno">
    <?php if (empty($user[0]['token'])) : ?>
      <p style="margin: 0; font-weight: bold; font-size: 24px;">Změnit heslo</p>
      <input type="password" name="password_old" class="form-control" placeholder="Heslo">
      <input type="password" name="password_new" class="form-control" placeholder="Nové heslo">
    <?php endif; ?>
    <button type="submit" class="btn btn-danger">Změnit</button>
  </form>
</div>
<?php require '../components/Footer.php'; ?>