<?php
if (!isset($_SESSION)) {
  session_start();
}

if (isset($_SESSION['email'])) {
  header('Location: index.php');
  exit();
}

require_once('db/user.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if (!isset($_POST['email']) || !isset($_POST['password'])) {
    $error = 'Email and password are required';
    return;
  }

  $email = $_POST['email'];
  $password = $_POST['password'];

  $userDB = new UsersDB;

  $user = $userDB->login($email, $password);

  if ($user) {
    $_SESSION['email'] = $user['email'];
    $_SESSION['privilege'] = $user['privilege'];
    header('Location: index.php?success=true&action=login');
    exit();
  } else {
    $error = 'Invalid email or password';
  }
}

?>

<?php require_once('includes/header.php'); ?>

<div class="flex max-w-64 flex-col mt-4 ml-auto mr-auto">
  <?php if (isset($error)) : ?>
    <div class="p-2 m-2 bg-red text-white rounded-xl">
      <?php echo $error; ?>
    </div>
  <?php endif; ?>
  <form class="contents" method="post">
    <input type="email" class="p-2 m-2 rounded-xl border" placeholder="Email" name="email" required>
    <input type="password" class="p-2 m-2 rounded-xl border" placeholder="Password" name="password" required>
    <button class="p-2 m-2 rounded-xl bg-blue text-white" type="submit">Login</button>
  </form>
</div>

<?php require_once('includes/footer.php'); ?>