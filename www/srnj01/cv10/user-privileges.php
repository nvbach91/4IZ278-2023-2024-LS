<?php

require_once('includes/superadmin_required.php');

require_once('includes/header.php');

require_once('db/user.php');

$userDB = new UsersDB;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if (isset($_POST['email']) && isset($_POST['privilege'])) {

    $email = $_POST['email'];
    $privilege = $_POST['privilege'];

    $userDB->setPrivilege($email, $privilege);
    $message = "Privilege $privilege set for $email";
  } else {
    $error = 'Email and privilege are required';
  }
}

$users = $userDB->getUsers();

?>

User privileges

<div class="flex max-w-96 flex-col mt-4 ml-auto mr-auto">
  <?php if (isset($error)) : ?>
    <div class="p-2 m-2 bg-red text-white rounded-xl">
      <?php echo $error; ?>
    </div>
  <?php endif; ?>
  <?php if (isset($message)) : ?>
    <div class="p-2 m-2 bg-green text-white rounded-xl">
      <?php echo $message; ?>
    </div>
  <?php endif; ?>
</div>
<div class="grid grid-cols-3 max-w-[512px] mt-4 ml-auto mr-auto items-center">
  <?php foreach ($users as $user) : ?>
    <form class="contents" method="post">
      <input type="hidden" name="email" value="<?php echo $user['email']; ?>" />
      <span><?php echo $user['email']; ?></span>
      <input type="number" name="privilege" class="p-2 m-2 rounded-xl border" value="<?php echo $user['privilege']; ?>" />
      <button class="p-2 m-2 rounded-xl bg-blue text-white" href="edit-user-privilege.php?email=<?php echo $user['email']; ?>" type="submit">Set</button>
    </form>
  <?php endforeach; ?>
</div>

<?php

require_once('includes/footer.php');
