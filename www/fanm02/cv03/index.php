<?php

$submited = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $submited = true;

    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $phone = htmlspecialchars(trim($_POST['phone']));
    $avatar = htmlspecialchars(trim($_POST['avatar']));
    $sex = isset($_POST['sex']) ? htmlspecialchars(trim($_POST['sex'])) : '';
    $deck = isset($_POST['deck']) ? htmlspecialchars(trim($_POST['deck'])) : '';
    $card = isset($_POST['card']) ? htmlspecialchars(trim($_POST['card'])) : 0;

    $success_message = "Registration successful!";

    $error_messages = array();

    if (empty($name)) {
        array_push($error_messages, 'Name is required');
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        array_push($error_messages, 'Valid email is required');
    }

    if (empty($phone) | !preg_match('/^(\\+\\d{2,3})?( ?\\d{3}){3}$/', $phone)) {
        array_push($error_messages, 'Valid phone is required');
    }

    if (!filter_var($avatar, FILTER_VALIDATE_URL)) {
        array_push($error_messages, 'Valid avatar URL is required');
    }
}
?>

<?php include 'components/header.php'; ?>

<form class="form-signup" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <?php if ($submited && count($error_messages) > 0): ?>
        <div class="error">
            <?php
                foreach($error_messages as $error) {
                    echo "$error <br>";
                }
            ?>
        </div>
    <?php elseif ($submited): ?>
        <div class="success">
            <?php echo $success_message; ?>
        </div>
    <?php endif; ?>
    <div class="form-group">
        <label>Name*</label>
        <input class="form-control" name="name" value="<?php echo isset($name) ? $name : ''; ?>">
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
        <input class="form-control" name="avatar" type="url" value="<?php echo isset($avatar) ? $avatar : ''; ?>">
    </div>
    <div class="form-group">
        <label>Sex</label>
        <select name="sex" class="form-control">
            <option value="no">Prefer not to answer</option>
            <option value="male">Male</option>
            <option value="female">Female</option>
        </select>
    </div>
    <div class="form-group">
        <label>Deck name</label>
        <input class="form-control" name="deck" value="<?php echo isset($deck) ? $deck : ''; ?>">
    </div>
    <div class="form-group">
        <label>Card count</label>
        <input class="form-control" name="card" type="number" min="0" value="<?php echo isset($card) ? $card : ''; ?>">
    </div>
    <button class="btn btn-primary" type="submit">Submit</button>
</form>

<?php include 'components/footer.php'; ?>
