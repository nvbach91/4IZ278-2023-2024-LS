<?php
require('./utils/db.php');

const DB_FILE = './users.db';

if (!empty($_POST)) {
  $email = htmlspecialchars(trim($_POST['email']));
  $password = htmlspecialchars(trim($_POST['password']));

  $errors = [];
  if (strlen($email) < 3) {
    $errors['email'] = "Please enter your email.";
  }
  if (strlen($password) < 3) {
    $errors['password'] = "Please enter your passeord.";
  }

  if (count($errors) == 0) {
    $user = fetchUser(DB_FILE, $email);

    if (!$user) {
      $errors['email'] = "Email is not registered.";
    } else {
      if (!password_verify($password, $user['password'])) {
        $errors['password'] = "Password is incorrect.";
      } else {
        $success = true;
      }
    }
  }
} else {
  $email = $_GET['user'];
}

include('./includes/header.php') ?>
<div class="m-4 mx-auto w-fit">
  <?php
  if (isset($success) && $success) {
  ?>
    <p class="text-green mb-4">Welcome, <?php echo $user['name'] ?>!</p>
    <img src="<?php echo $user['avatar'] ?>" class="h-16 w-16 rounded-full m-auto" alt="avatar">
    <a class="bg-green text-white rounded h-8 block flex justify-center content-center leading-8 mt-4" href="<?php echo $_SERVER['REQUEST_URI'] ?>">Logout</a>
  <?php
  } else {
  ?>
    <h2 class="text-xl bold max-w-fit mb-4">Formulář</h2>
    <form class="max-w-96 w-[90vw] flex flex-col gap-6" method="POST" action="">
      <div class="flex gap-0.5 flex-col">
        <label for="email" class="mb-1">Email*</label>
        <input class="border-2 rounded h-8 px-2 <?php echo isset($errors['email']) ? 'border-red-500' : '' ?>" name="email" id="email" value="<?php echo isset($email) ? $email : '' ?>">
        <?php echo isset($errors['email']) ? '<p class="text-red-500">' . $errors['email'] . '</p>' : '' ?>
      </div>
      <div class="flex gap-0.5 flex-col">
        <label for="password" class="mb-1">Password*</label>
        <input class="border-2 rounded h-8 px-2 <?php echo isset($errors['password']) ? 'border-red-500' : '' ?>" name="password" id="password" value="<?php echo isset($password) ? $password : '' ?>">
        <?php echo isset($errors['password']) ? '<p class="text-red-500">' . $errors['password'] . '</p>' : '' ?>
      </div>
      <button class="bg-green text-white rounded h-8  <?php if (isset($success) && $success) echo "cursor-not-allowed bg-green-200" ?>" type="submit" <?php if (isset($success) && $success) echo "disabled" ?>>Login</button>
    </form>
  <?php } ?>
</div>
<?php include('./includes/footer.php') ?>