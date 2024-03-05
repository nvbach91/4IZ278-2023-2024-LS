<?php
if (!empty($_POST)) {
    $name = $_POST["name"];
    $gender = $_POST["gender"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $avatar = $_POST["avatar"];
    $packName = $_POST["packName"];
    $number = $_POST["number"];

    // validity check
    $errors = [];
    if (empty($name)) {
        array_push($errors, "You must enter name!");
    }
    if ($gender == "default") {
        array_push($errors, "You must enter gender!");
    }
    if (empty($email) || !preg_match("/\w+@\w+\.\w+/", $email)) {
        array_push($errors, "You must enter valid email!");
    }
    if (empty($phone) || !preg_match("/^(\+420\d{9}|\d{9})$/", $phone)) {
        array_push($errors, "You must enter valid phone number!");
    }
    if (empty($avatar) || !preg_match("/^(http|https)\:\/\/\w+\.\w+\/\w+\.(png|jpg|jpeg|gif)$/", $avatar)) {
        array_push($errors, "You must enter valid avatar path!");
    }
    if (empty($packName)) {
        array_push($errors, "You must enter pack name!");
    }
    if (empty($number) || intval($number) < 1) {
        array_push($errors, "Card number must be at least 1!");
    }
}
?>

<?php include "./includes/header.php" ?>

<h1>Registration</h1>

<form class="form-signup" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <div class="alert alert-danger">
        <?php
        if (isset($errors)) {
            foreach ($errors as $error) {
                echo $error . "<br/>";
            }
        }
        ?>
    </div>
    <div class="alert alert-success">
        <?php
        if (isset($errors) && count($errors) == 0) {
            echo "Account successfully registered!";
        }
        ?>
    </div>
    <div class="form-group">
        <label>Name*</label>
        <input class="form-control" name="name" value="<?php echo isset($name) ? $name : ''; ?>">
    </div>
    <div class="form-group">
        <label>Gender</label>
        <select class="form-control" name="gender">
            <option value="default" <?php echo (!isset($gender) || empty($gender)) ? "selected" : ""; ?>>Choose your gender</option>
            <option value="male" <?php echo (isset($gender) && $gender == "male") ? "selected" : ""; ?>>Male</option>
            <option value="female" <?php echo (isset($gender) && $gender == "female") ? "selected" : ""; ?>>Female</option>
        </select>
    </div>
    <div class="form-group">
        <label>Email*</label>
        <input class="form-control" name="email" value="<?php echo isset($email) ? $email : ''; ?>">
    </div>
    <div class="form-group">
        <label>Phone*</label>
        <input class="form-control" name="phone" value="<?php echo isset($phone) ? $phone : ''; ?>">
    </div>
    <div class="form-group">
        <label>Avatar URL*</label>
        <input class="form-control" name="avatar" value="<?php echo isset($avatar) ? $avatar : ''; ?>">
    </div>
    <div class="form-group">
        <label>Pack name</label>
        <input class="form-control" name="packName" value="<?php echo isset($packName) ? $packName : ''; ?>">
    </div>
    <div class="form-group">
        <label>Number of cards</label>
        <input class="form-control" type="number" name="number" value="<?php echo isset($number) ? $number : ''; ?>">
    </div>
    <button class="btn btn-primary" type="submit">Submit</button>
</form>

<?php include "./includes/footer.php" ?>