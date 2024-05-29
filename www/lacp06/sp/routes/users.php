<?php

require_once '../db/database_class.php';
require_once '../utils/admin-check.php';

$usersDB = new UsersDB();

$users = $usersDB->findUsers($_COOKIE['name']);
$action = $_SERVER['PHP_SELF'];

if (!empty($_POST)) {
  $email = htmlspecialchars(trim($_POST['email']));
  $privileges = $_POST['privileges'];

  $errors = [];

  if (!is_numeric($privileges)) {
    array_push($errors, $privileges);
  }

  if (count($errors) == 0) {
    $usersDB->changePrivileges($email, $privileges);
  }
}

?>

<?php require '../components/Header.php'; ?>
<div class="comic-container">
  <div class="comic-headline">
    <h1>Uživatelé</h1>
  </div>
  <div style="border-top: 3px solid grey;">
    <div class="comic-print">
      <div class="user-print">
        <?php foreach ($users as $user) : ?>
          <form id="change_privilege" action="<?php echo $action; ?>" method="POST">
            <div class="user-container">
              <div class="email"><?php echo $user['email']; ?></div>
              <input type="hidden" name="email" value="<?php echo $user['email']; ?>">
              <select name="privileges" class="form-select comic-select">
                <option value="1" <?php echo $user['privileges'] == 1 ? 'selected' : ''; ?>>Zákazník</option>
                <option value="2" <?php echo $user['privileges'] == 2 ? 'selected' : ''; ?>>Manažer</option>
              </select>
              <button type="submit" class="btn btn-danger">Změnit</button>
            </div>
          </form>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
</div>
<?php require '../components/Footer.php'; ?>