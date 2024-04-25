<?php

require_once './db/database_eshop.php';

require_once 'admin-check.php';

$usersDB = new UsersDB();

$users = $usersDB->findUsers($_COOKIE['name']);
$action = $_SERVER['PHP_SELF'];


if (!empty($_POST)) {
  $email = htmlspecialchars(trim($_POST['email']));
  $privileges = htmlspecialchars(($_POST['privileges']));

  $errors = [];

  if (!is_numeric($privileges)) {
    array_push($errors, $privileges);
  }

  if (count($errors) == 0) {
    $usersDB->changePrivileges($email, $privileges);
  }
}

?>

<?php require __DIR__ . '/includes/Header.php'; ?>
<div class="container">
  <div style="margin-top: 15px; margin-bottom: 15px;">
    <?php foreach ($users as $user) : ?>
      <div class="card" style="width: 18rem;">
        <div class="card-body">
          <h5 class="card-title"><?php echo $user['email']; ?></h5>
          <form action="<?php echo $action; ?>" method="POST">
            <input type="hidden" name="email" value="<?php echo $user['email']; ?>">
            <select class="form-select" name="privileges">
              <option <?php echo $user['privileges'] == 1 ? "selected" : "" ?> value="1">User</option>
              <option <?php echo $user['privileges'] == 2 ? "selected" : "" ?> value="2">Manager</option>
              <option <?php echo $user['privileges'] == 3 ? "selected" : "" ?> value="3">Admin</option>
            </select>
            <button type="submit" class="btn btn-primary">Change</button>
          </form>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</div>
<div style="position: absolute; bottom: 0; width: 100%;">
  <?php require __DIR__ . '/includes/Footer.php'; ?>
</div>