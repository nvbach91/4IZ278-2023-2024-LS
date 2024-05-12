<?php
require_once '../db/database_class.php';

$usersDB = new UsersDB();
$action = $_SERVER['PHP_SELF'];

?>

<?php require '../components/Header.php'; ?>
<div class="container">
  <form class="comic-login" action="<?php echo $action ?>" method="POST" style="display: flex; flex-direction: column; height: 600px; justify-content: center;">
    <input type="email" name="email" class="form-control" placeholder="Email">
    <input type="password" name="password" class="form-control" placeholder="Heslo">
    <button type="submit" class="btn btn-danger">Přihlásit</button>
  </form>
</div>
<div style="position: absolute; bottom: 0; width: 100%;">
  <?php require '../components/Footer.php'; ?>
</div>

<style lang="css">
  .comic-login {
    display: flex;
    flex-direction: column;
    gap: 20px;
  }
</style>