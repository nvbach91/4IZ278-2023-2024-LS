<?php
$avatar = '';
if (!empty($_POST)) {
    $name = htmlspecialchars(trim($_POST['name']));
    $gender = htmlspecialchars(trim($_POST['gender']));
    $email = htmlspecialchars(trim($_POST['email']));
    $phone = htmlspecialchars(trim($_POST['phone']));
    $avatar = htmlspecialchars(trim($_POST['avatar']));
    $packageName = htmlspecialchars(trim($_POST['packageName']));
    $cardsInPackageCount = htmlspecialchars(trim($_POST['cardsInPackageCount']));

    $errors = [];

    if (strlen($name) < 3) {
        array_push($errors, "Your name must have 3 or more characters");
    }
    if (! filter_var($email, FILTER_VALIDATE_EMAIL)) {
        array_push($errors, "Please use a valid email");
    }
    if (! preg_match('/^(\\+\\d{2,3})?( ?\\d{3}){3}$/', $phone)) {
        array_push($errors, "Please use a valid phone number");
    }
    if (! filter_var($avatar, FILTER_VALIDATE_URL)) {
        array_push($errors, "Please use a valid avatar url");
    }
    if (strlen($packageName) < 3) {
        array_push($errors, "Your package name must have 3 or more characters");
    }
    if (! filter_var($cardsInPackageCount, FILTER_VALIDATE_INT) || $cardsInPackageCount <= 0) {
        array_push($errors, "Please use a valid positive integer for package size");
    }

    if (count($errors) == 0) {
        $successMessage = 'Thank you for your registration';
    }
}
?>

<form class="form-signup" method="POST" action="<?php echo $_SERVER['PHP_SELF'] ?>">
    <div class="headline">Form validation example</div>
    <div class="headline">Registration form</div>
    <?php if (! empty($errors)): ?>
        <div class="form-errors">
            <?php foreach($errors as $error): ?>
                <p><?php echo $error;?></p>
            <?php endforeach;?>
        </div>
    <?php else :?>
        <?php if (strlen($avatar) > 0): ?>
            <div class="form-success">
                <p><?php echo $successMessage;?></p>
                <div class="avatar">
                    <img
                        src="<?php echo $avatar; ?>"
                        alt="<?php echo "avatar"; ?>"
                    >
                </div>
            </div>
        <?php endif;?>
    <?php endif;?>
    <div class="form-group">
        <label>Name*</label>
        <input class="form-control" name="name" placeholder="e.g. Homer Simpson" value="<?php echo isset($name) ? $name : '' ?>">
    </div>
    <div class="form-group">
        <label>Gender*</label>
        <select class="form-select" name="gender">
            <option <?php echo isset($gender) && $gender == 'N' ? 'selected' : ''; ?> value="N">Neutral</option>
            <option <?php echo isset($gender) && $gender == 'F' ? 'selected' : ''; ?> value="F">Female</option>
            <option <?php echo isset($gender) && $gender == 'M' ? 'selected' : ''; ?> value="M">Male</option>
        </select>
    </div>
    <div class="form-group">
        <label>Email*</label>
        <input class="form-control" name="email" placeholder="e.g.  example@gmail.com" value="<?php echo isset($email) ? $email : '' ?>">
    </div>
    <div class="form-group">
        <label>Phone*</label>
        <input class="form-control" name="phone" placeholder="e.g.  +420 123 456 789" value="<?php echo isset($phone) ? $phone : '' ?>">
    </div>
    <div class="form-group">
        <label>Avatar URL*</label>
        <input class="form-control" name="avatar" placeholder="e.g.  https://eso.vse.cz/~nguv03/cv03/img/homer.jpg" value="<?php echo isset($avatar) ? $avatar : '' ?>">
    </div>
    <div class="form-group">
        <label>Package Name</label>
        <input class="form-control" name="packageName" placeholder="e.g.  Magic deck" value="<?php echo isset($packageName) ? $packageName : '' ?>">
    </div>
    <div class="form-group">
        <label>Package Size</label>
        <input class="form-control" name="cardsInPackageCount" placeholder="e.g.  42" value="<?php echo isset($cardsInPackageCount) ? $cardsInPackageCount : '' ?>">
    </div>
    <button class="btn btn-primary" type="submit">
        <p>Submit</p>
    </button>
</form>
