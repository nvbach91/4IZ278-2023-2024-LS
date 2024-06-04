<?php require __DIR__ . '/include/profile-navigation.php'; ?>

<?php

require_once __DIR__ . '/db/UsersDB.php';
require_once __DIR__ . '/validators/UserValidator.php';

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $current_password = htmlspecialchars(trim($_POST['current_password']));
    $new_password = htmlspecialchars(trim($_POST['new_password']));
    $confirm_password = htmlspecialchars(trim($_POST['confirm_password']));
    $userId = $_SESSION['user_id'];

    $validator = new UserValidator();
    $errors = $validator->validatePasswordChange($userId, $current_password, $new_password, $confirm_password);

    if (empty($errors)) {
        $userDB = new UsersDB();
        $new_password_hash = password_hash($new_password, PASSWORD_DEFAULT);
        $result = $userDB->updatePassword($userId, $new_password_hash);

        if ($result) {
            header('Location: profile.php');
            exit;
        } else {
            $errors[] = "Změna hesla selhala.";
        }
    }
}
?>

<div class="container mt-5">
    <h2>Změnit heslo</h2>
    <form action="change-password" method="post">
        <?php if (!empty($errors)): ?>
            <div class="alert alert-danger">
                <?php foreach ($errors as $error): ?>
                    <p><?php echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
        <div class="form-group">
            <label for="current_password">Aktuální heslo:</label>
            <input type="password" class="form-control" id="current_password" name="current_password" required>
        </div>
        <div class="form-group">
            <label for="new_password">Nové heslo:</label>
            <input type="password" class="form-control" id="new_password" name="new_password" required>
        </div>
        <div class="form-group">
            <label for="confirm_password">Potvrzení nového hesla:</label>
            <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
        </div>
        <button type="submit" class="btn btn-primary">Změnit heslo</button>
    </form>
</div>

<?php require __DIR__ . '/include/footer.php'; ?>
