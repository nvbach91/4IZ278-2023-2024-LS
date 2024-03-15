<?php

require('./utils/db.php');

const DB_FILE = './users.db';

if (!empty($_POST)) {
  $name = htmlspecialchars(trim($_POST['name']));
  $email = htmlspecialchars(trim($_POST['email']));
  $password = htmlspecialchars(trim($_POST['password']));
  $password_verify = htmlspecialchars(trim($_POST['password_verify']));
  $phone = htmlspecialchars(trim($_POST['phone']));
  $avatar = htmlspecialchars(trim($_POST['avatar']));
  $gender = htmlspecialchars(trim($_POST['gender']));
  $deck = htmlspecialchars(trim($_POST['deck']));
  $cards = htmlspecialchars(trim($_POST['cards']));

  $errors = [];
  if (strlen($name) < 3) {
    $errors['name'] = "Name has to be at least 3 characters long";
  }
  if (!filter_var($email, FILTER_VALIDATE_EMAIL) || !str_ends_with($email, '@vse.cz')) {
    $errors['email'] = "Email is required and has to be on vse.cz domain";
  }
  if (fetchUser(DB_FILE, $email) !== null) {
    $errors['email'] = "Email is already registered";
  }
  if (strlen($password) < 8) {
    $errors['password'] = "Password has to be at least 8 characters long";
  }
  if ($password !== $password_verify || strlen($password_verify) == 0) {
    $errors['password_verify'] = "Passwords do not match";
  }
  if (!filter_var($avatar, FILTER_VALIDATE_URL)) {
    $errors['avatar'] = "Avatar URL is required";
  }
  if (!preg_match('/^(\+420)? ?[1-9][0-9]{2} ?[0-9]{3} ?[0-9]{3}$/', $phone)) {
    $errors['phone'] = "Phone has to be at least 9 characters long";
  }
  if (strlen($deck) < 1) {
    $errors['deck'] = "Set deck!";
  }
  if (!filter_var($cards, FILTER_VALIDATE_INT)) {
    $errors['cards'] = "Set a whole number amount of cards in your deck.";
  }
}

if (isset($errors) && count($errors) === 0) {
  $success = true;
  $id = getNextId(DB_FILE);
  $user = implode(';', [$id, $name, $email, password_hash($password, PASSWORD_DEFAULT), $phone, $avatar, $gender, $deck, $cards]);
  addUser(DB_FILE, $user);

  header('Location: ' . $_SERVER['REQUEST_URI'] . 'login.php?user=' . $email);
}
?>

<?php include('./includes/header.php') ?>

<div class="m-4 mx-auto w-fit">
  <h2 class="text-xl bold max-w-fit mb-4">Formulář</h2>
  <form class="max-w-96 w-[90vw] flex flex-col gap-6" method="POST" action="">
    <div class="flex gap-0.5 flex-col">
      <label for="name" class="mb-1">Name*</label>
      <input class="border-2 rounded h-8 px-2 <?php echo isset($errors['name']) ? 'border-red-500' : '' ?>" name="name" id="name" value="<?php echo isset($name) ? $name : '' ?>">
      <?php echo isset($errors['name']) ? '<p class="text-red-500">' . $errors['name'] . '</p>' : '' ?>
    </div>
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
    <div class="flex gap-0.5 flex-col">
      <label for="password_verify" class="mb-1">Password verification*</label>
      <input class="border-2 rounded h-8 px-2 <?php echo isset($errors['password_verify']) ? 'border-red-500' : '' ?>" name="password_verify" id="password_verify" value="<?php echo isset($password_verify) ? $password_verify : '' ?>">
      <?php echo isset($errors['password_verify']) ? '<p class="text-red-500">' . $errors['password_verify'] . '</p>' : '' ?>
    </div>
    <div class="flex gap-0.5 flex-col">
      <label for="phone" class="mb-1">Phone*</label>
      <input class="border-2 rounded h-8 px-2 <?php echo isset($errors['phone']) ? 'border-red-500' : '' ?>" name="phone" id="phone" value="<?php echo isset($phone) ? $phone : '' ?>">
      <?php echo isset($errors['phone']) ? '<p class="text-red-500">' . $errors['phone'] . '</p>' : '' ?>
    </div>
    <div class="flex gap-0.5 flex-col">
      <?php
      if (!isset($errors['avatar']) && isset($avatar)) echo '<img alt="avatar" src="' . $avatar . '" class="h-12 w-12 rounded-full mb-1">';
      ?>
      <label for="avatar" class="mb-1">Avatar URL*</label>
      <input class="border-2 rounded h-8 px-2 <?php echo isset($errors['avatar']) ? 'border-red-500' : '' ?>" name="avatar" id="avatar" value="<?php echo isset($avatar) ? $avatar : '' ?>">
      <?php echo isset($errors['avatar']) ? '<p class="text-red-500">' . $errors['avatar'] . '</p>' : '' ?>
    </div>
    <div class="flex gap-0.5 flex-col">
      <label>Gender*</label>
      <select name="gender">
        <option value="n" <?php echo isset($gender) && $gender === 'n' ? ' selected' : '' ?>>Preffer not to say</option>
        <option value="f" <?php echo isset($gender) && $gender === 'f' ? ' selected' : '' ?>>Female</option>
        <option value="m" <?php echo isset($gender) && $gender === 'm' ? ' selected' : '' ?>>Male</option>
      </select>
    </div>
    <div class="flex gap-0.5 flex-col">
      <label for="deck" class="mb-1">Deck*</label>
      <input class="border-2 rounded h-8 px-2 <?php echo isset($errors['deck']) ? 'border-red-500' : '' ?>" name="deck" id="deck" value="<?php echo isset($deck) ? $deck : '' ?>">
      <?php echo isset($errors['deck']) ? '<p class="text-red-500">' . $errors['deck'] . '</p>' : '' ?>
    </div>
    <div class="flex gap-0.5 flex-col">
      <label for="cards" class="mb-1">Amount of Cards in Your Deck*</label>
      <input class="border-2 rounded h-8 px-2 <?php echo isset($errors['cards']) ? 'border-red-500' : '' ?>" name="cards" id="cards" value="<?php echo isset($cards) ? $cards : '' ?>">
      <?php echo isset($errors['cards']) ? '<p class="text-red-500">' . $errors['cards'] . '</p>' : '' ?>
    </div>
    <button class="bg-green text-white rounded h-8  <?php if (isset($success) && $success) echo "cursor-not-allowed bg-green-200" ?>" type="submit" <?php if (isset($success) && $success) echo "disabled" ?>>Submit</button>
  </form>
</div>

<?php include('./includes/footer.php') ?>