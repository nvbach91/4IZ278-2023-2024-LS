<?php require __DIR__ . '/include/header.php'; ?>
<?php

require_once __DIR__ . '/validators/UserValidator.php';

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $first_name = htmlspecialchars(trim($_POST['first_name']));
    $last_name = htmlspecialchars(trim($_POST['last_name']));
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $phone = htmlspecialchars(trim($_POST['phone']));
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    $validator = new UserValidator();
    $errors = $validator->validateRegistration($first_name, $last_name, $email, $phone, $password, $confirm_password);

    if (empty($errors)) {
        $phone = $validator->validateAndFormatPhone($phone);
        $userDB = new UsersDB();
        $result = $userDB->create($first_name, $last_name, $email, $phone, $password);

        if ($result) {
            header('Location: login.php');
            exit;
        } else {
            $errors[] = "Registrace selhala.";
        }
    }
}
?>

<div class="container">
    <h2 class="mt-5">Registrace</h2>
    <form method="post">
        <?php if (!empty($errors)): ?>
            <div class="alert alert-danger">
                <?php foreach ($errors as $error): ?>
                    <p><?php echo htmlspecialchars($error); ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
        <div class="form-group">
            <label for="first_name">Jméno:</label>
            <input type="text" class="form-control" id="first_name" name="first_name" value="<?php echo htmlspecialchars($first_name ?? ''); ?>" required>
        </div>
        <div class="form-group">
            <label for="last_name">Příjmení:</label>
            <input type="text" class="form-control" id="last_name" name="last_name" value="<?php echo htmlspecialchars($last_name ?? ''); ?>" required>
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($email ?? ''); ?>" required>
        </div>
        <div class="form-group">
            <label for="phone">Telefonní číslo:</label>
            <input type="tel" class="form-control" id="phone" name="phone" value="<?php echo htmlspecialchars($phone ?? ''); ?>" required>
            <small class="form-text text-muted">zadejte telefonní číslo ve tvaru +420 xxx xxx xxx</small>
        </div>
        <div class="form-group">
            <label for="password">Heslo:</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <div class="form-group">
            <label for="confirm_password">Potvrzení hesla:</label>
            <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
        </div>
        <button type="submit" class="btn btn-primary">Registrovat</button>
    </form>
</div>

<?php require __DIR__ . '/include/footer.php'; ?>
