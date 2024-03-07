<?php
if (!empty($_POST)) {
  $name = htmlspecialchars($_POST['name']);
  $email = htmlspecialchars($_POST['email']);
  $phone = htmlspecialchars($_POST['phone']);
  $avatar = htmlspecialchars($_POST['avatar']);

  $errors = [];
  if (strlen($name) < 3) {
    $errors['name'] = "Name has to be at least 3 characters long";
  }
  if (!filter_var($email, FILTER_VALIDATE_EMAIL) || !str_ends_with($email, '@vse.cz')) {
    $errors['email'] = "Email is required and has to be on vse.cz domain";
  }
  if (!filter_var($avatar, FILTER_VALIDATE_URL)) {
    $errors['avatar'] = "Avatar URL is required";
  }
  if (!preg_match('/^(\+420)? ?[1-9][0-9]{2} ?[0-9]{3} ?[0-9]{3}$/', $phone)) {
    $errors['phone'] = "Phone has to be at least 9 characters long";
  }
}

if (isset($errors) && count($errors) === 0) {
  mail(
    $email,
    "Formulář odeslán",
    "Děkujeme za vyplnění formuláře",
    [
      'From' => $email,
      'Reply-To' => $email,
      'Content-Type' => 'text/html; charset=UTF-8',
      'X-Mailer' => 'PHP/' . phpversion()
    ]
  );
  $success = true;

  // Unset variables to clear the form
  // unset($name);
  // unset($email);
  // unset($phone);
  // unset($avatar);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Formulář v1</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;1,100;1,200;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      theme: {
        fontFamily: {
          'sans': ['IBM Plex Sans', 'sans-serif'],
        },
        extend: {
          colors: {
            'white': '#fff',
            'green': '#7B886F',
            'green-200': '#D8E2C7',
          }
        }
      }
    }
  </script>
</head>

<body>
  <div class="m-4 mx-auto w-fit">
    <h2 class="text-xl bold max-w-fit mb-4">Formulář</h2>
    <?php
    if (isset($success) && $success)
      echo '<p class="text-green mb-4">Formulář byl úspěšně odeslán</p>';
    ?>
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
      <button class="bg-green text-white rounded h-8  <?php if (isset($success) && $success) echo "cursor-not-allowed bg-green-200" ?>" type="submit" <?php if (isset($success) && $success) echo "disabled" ?>>Submit</button>
    </form>
  </div>
</body>

</html>