<?php

require_once '../db/database_class.php';
require_once '../utils/manager-check.php';
session_start();

$worldsDB = new WorldsDB();
$action = $_SERVER['PHP_SELF'];

if (isset($_GET['world_id'])) {
  $world = $worldsDB->findById($_GET['world_id']);
  if (empty($world)) {
    header('Location: /www/lacp06/sp/routes/index.php');
    exit();
  }
  $_SESSION['admin_world']['world_id'] = $_GET['world_id'];
  $timestamp = date('Y-m-d H:i:s');
  $_SESSION['world_timestamp'] = $timestamp;
  $worldsDB->updateTimestamp($_SESSION['admin_world']['world_id'], $timestamp);

  $_SESSION['admin_world']['name'] = $world[0]['name'];
  $_SESSION['admin_world']['description'] = $world[0]['description'];
  $_SESSION['admin_world']['image'] = $world[0]['image'];
}

if (!empty($_POST)) {
  $name = htmlspecialchars(trim($_POST['name']));
  $_SESSION['admin_world']['name'] = $name;
  $description = htmlspecialchars(trim($_POST['description']));
  $_SESSION['admin_world']['description'] = $description;
  $image = htmlspecialchars(trim($_POST['image']));
  $_SESSION['admin_world']['image'] = $image;

  $errors = [];

  if (strlen($name) < 3) {
    empty($name) ? $name_check = "Název je povinný!" : $name_check = "Název musí být alespoň 3 znaky!";
    array_push($errors, $name_check);
  }
  if (strlen($description) < 10) {
    empty($description) ? $description_check = "Popis je povinný!" : $description_check = "Popis musí být alespoň 10 znaků!";
    array_push($errors, $description_check);
  }
  if (strlen($image) < 3) {
    empty($image) ? $image_check = "URL obrázku je povinné!" : $image_check = "URL obrázku musí být alespoň 3 znaky!";
    array_push($errors, $image_check);
  }
  if (count($errors) == 0) {
    $world = $worldsDB->findById($_SESSION['admin_world']['world_id']);
    if ($world[0]['last_update'] == $_SESSION['world_timestamp']) {
      $successMessage = "Svět upraven!";
      $worldsDB->update($world[0]['id'], $name, $description, $image);
      $worldsDB->updateTimestamp($world[0]['id'], date('0000-00-00 00:00:00'));
    } else {
      array_push($errors, "Svět je již upravován, uložte svou práci před zavřením této stránky!");
    }
  }
}

if (isset($_SESSION['admin_world'])) {
  $saved_name = $_SESSION['admin_world']['name'];
  $saved_description = $_SESSION['admin_world']['description'];
  $saved_image = $_SESSION['admin_world']['image'];
} else {
  $saved_name = "";
  $saved_description = "";
  $saved_image = "";
}

?>

<?php require_once '../components/Header.php'; ?>
<div class="container">
  <form class="comic-login" action="<?php echo $action ?>" method="POST">
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
    <input type="text" name="name" class="form-control" placeholder="* Název" value="<?php echo $saved_name; ?>">
    <textarea name="description" class="form-control" placeholder="* Popis"><?php echo $saved_description; ?></textarea>
    <input type="text" name="image" class="form-control" placeholder="* Obrázek" value="<?php echo $saved_image; ?>">
    <button type="submit" class="btn btn-danger">Upravit</button>
  </form>
</div>
<?php require_once '../components/Footer.php'; ?>