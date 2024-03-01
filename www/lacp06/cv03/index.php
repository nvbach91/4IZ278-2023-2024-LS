<?php
$action = $_SERVER['PHP_SELF'];

if (!empty($_POST)) {
  $name = htmlspecialchars(trim($_POST['name']));
  $email = htmlspecialchars(trim($_POST['email']));
  $phone = htmlspecialchars(trim($_POST['phone']));
  $avatar = htmlspecialchars(trim($_POST['avatar']));

  $errors = [];
  if (strlen($name) < 3) {
    empty($name) ? $name_check = "Name is required!" : $name_check = $name . " must have 3 or more characters!";
    array_push($errors, $name_check);
  }
  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    empty($email) ? $email_check = "Email is required!" : $email_check = $email . " is not a valid email adress!";
    array_push($errors, $email_check);
  }
  if (!preg_match('^(\\+\\d{2,3})?( ?\\d{3}){3}$^', $phone)) {
    empty($phone) ? $phone_check = "Phone number is required!" : $phone_check = $phone . " is not a valid phone number. e.g. +420 666 777 888";
    array_push($errors, $phone_check);
  }
  if (!filter_var($avatar, FILTER_VALIDATE_URL)) {
    empty($avatar) ? $avatar_check = "Avatar URL is required!" : $avatar_check = $avatar . " is not a valid URL adress!";
    array_push($errors, $avatar_check);
  }

  if (count($errors) == 0) {
    $successMessage = "Thank you for your registration!";
    mail(
      "lacp06@vse.cz",
      "Registration was successful",
      '<h1>Thank you for your registration</h1>',
    );
  }
}

?>
<?php include "./includes/header.php"; ?>
<div class="container base">
  <h1>Form</h1>
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
  <form class="form-signup" method="post" action="<?php echo $action; ?>">
    <div class="form-group">
      <label>*Name</label>
      <input class="form-control" name="name" value="<?php echo isset($name) ? $name : "" ?>">
    </div>
    <div class="form-group">
      <label>*Email</label>
      <input class="form-control" name="email" value="<?php echo isset($email) ? $email : "" ?>">
    </div>
    <div class="form-group">
      <label>Gender</label>
      <select class="form-control" name="gender">
        <option label="Undefined" <?php echo isset($gender) && $gender == "" ? 'selected' : ""; ?> value=""></option>
        <option label="Male" <?php echo isset($gender) && $gender == "M" ? 'selected' : ""; ?> value="M">M</option>
        <option label="Female" <?php echo isset($gender) && $gender == "F" ? 'selected' : ""; ?> value="F">F</option>
      </select>
    </div>
    <div class="form-group">
      <label>*Phone</label>
      <input class="form-control" name="phone" value="<?php echo isset($phone) ? $phone : "" ?>">
    </div>
    <div class="form-group">
      <label>*Avatar URL</label>
      <input class="form-control" name="avatar" value="<?php echo isset($avatar) ? $avatar : "" ?>">
    </div>
    <button class="btn btn-primary" type="submit">Submit</button>
  </form>
</div>
<?php include "./includes/footer.php"; ?>