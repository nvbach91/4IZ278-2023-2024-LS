<?php

$errors = [];
$successMess = "";

if (!empty($_POST)) {
    $name = htmlspecialchars(trim($_POST['name'], ' \n\r\t\v\x00'));
    $email = htmlspecialchars(trim($_POST['email'], ' \n\r\t\v\x00'));
    $gender = $_POST['gender'];
    $phone = htmlspecialchars(trim($_POST['phone'], ' \n\r\t\v\x00'));
    $avatar = htmlspecialchars(trim($_POST['avatar'], ' \n\r\t\v\x00'));
    $packname = htmlspecialchars(trim($_POST['packname'], ' \n\r\t\v\x00'));
    $packcount = htmlspecialchars(trim($_POST['packcount'], ' \n\r\t\v\x00'));

    $phone = str_replace([' ', '-', '/'], ['', '', ''], $phone);

    if (empty($name) || strlen($name) < 3 || strlen($name) > 30 || is_numeric($name) || !preg_match('/^([A-Z][a-z]+)\s([A-Z][a-z]+)((\s([A-Z][a-z]+))?)+$/', $name)) {
        array_push($errors, "Enter valid name");
    }
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        array_push($errors, "Enter valid email");
    }
    if (empty($phone) || !preg_match('/^(\+420)?[0-9]{9}$/', $phone)) {
        array_push($errors, "Enter valid phone number");
    }
    if (empty($avatar) || !filter_var($avatar, FILTER_VALIDATE_URL)) {
        array_push($errors, "Enter valid avatar");
    }
    if (empty($packname) || strlen($packname) < 3 || strlen($packname) > 30 || is_numeric($packname)) {
        array_push($errors, "Enter valid card pack name");
    }
    if (empty($packcount) || !is_numeric($packcount)) {
        array_push($errors, "Enter valid count of cards in your pack");
    }
    if (count($errors) == 0) {
        $successMess = "Thank you for your registration!";
        mail(
            $email,
            'Registration successful',
            '<h1>Thank you for your registration</h1>',
        );
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>turnaj-registrace</title>
    <link rel="stylesheet" href="./styles/style.css">
</head>

<body>
    <main>
        <h1><?php echo $successMess ?></h1>
        <form class="form-signup" method="POST" action="<?php $_SERVER['PHP_SELF'] ?>">
            <?php if (isset($_POST)) : ?>
                <?php foreach ($errors as $e) : ?>
                    <div class="alert alert-danger"><?php echo $e ?></div>
                <?php endforeach; ?>
            <?php endif; ?>
            <div class="form-group">
                <label>Name:</label>
                <br>
                <input class="form-control" name="name" value="<?php echo isset($name) ? $name : '' ?>">
            </div>
            <div class="form-group">
                <label>Email:</label>
                <br>
                <input class="form-control" name="email" value="<?php echo isset($email) ? $email : '' ?>">
            </div>
            <div class="form-group">
                <label>Phone:</label>
                <br>
                <input class="form-control" name="phone" value="<?php echo isset($phone) ? $phone : '' ?>">
            </div>
            <div class="form-group">
                <label>Avatar URL:</label>
                <br>
                <input class="form-control" name="avatar" value="<?php echo isset($avatar) ? $avatar : '' ?>">
            </div>
            <div class="form-group">
                <label>Card pack name:</label>
                <br>
                <input class="form-control" name="packname" value="<?php echo isset($packname) ? $packname : '' ?>">
            </div>
            <div class="form-group">
                <label>Cards in pack:</label>
                <br>
                <input class="form-control" name="packcount" value="<?php echo isset($packcount) ? $packcount : '' ?>">
            </div>
            <br>
            <div class="form-group">
                <label>Pohlaví</label>
                <select name="gender">
                    <option <?php echo isset($gender) && $gender == 'F' ? 'selected' : 'F'; ?> value="F">F</option>
                    <option <?php echo isset($gender) && $gender == 'M' ? 'selected' : 'M'; ?> value="M">M</option>
                </select>
            </div>
            <button class="btn btn-primary" type="submit">Submit</button>
        </form>

    </main>
</body>

</html>