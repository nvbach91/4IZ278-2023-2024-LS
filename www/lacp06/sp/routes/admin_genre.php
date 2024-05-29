<?php

require_once '../db/database_class.php';
require_once '../utils/manager-check.php';
session_start();

$genresDB = new GenresDB();
$action = $_SERVER['PHP_SELF'];

if (!empty($_POST)) {
  $name = htmlspecialchars(trim($_POST['name']));
  $_SESSION['admin_genre']['name'] = $name;
  $description = htmlspecialchars(trim($_POST['description']));
  $_SESSION['admin_genre']['description'] = $description;
  $image = htmlspecialchars(trim($_POST['image']));
  $_SESSION['admin_genre']['image'] = $image;

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
    $successMessage = "Žánr vytvořen!";
    $genresDB->create($name, $description, $image);
    unset($_SESSION['admin_genre']);
  }
}

if (isset($_SESSION['admin_genre'])) {
  $saved_name = $_SESSION['admin_genre']['name'];
  $saved_description = $_SESSION['admin_genre']['description'];
  $saved_image = $_SESSION['admin_genre']['image'];
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
    <button type="submit" class="btn btn-danger">Vytvořit</button>
  </form>
</div>
<?php require_once '../components/Footer.php'; ?>