<?php require __DIR__ . '/include/header.php'; ?>
<?php

require_once __DIR__ . '/validators/UserValidator.php';

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    $validator = new UserValidator();
    $errors = $validator->validateRegistration($first_name, $last_name, $email, $phone, $password, $confirm_password);

    if (empty($errors)) {
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
            <input type="text" class="form-control" id="first_name" name="first_name" required>
        </div>
        <div class="form-group">
            <label for="last_name">Příjmení:</label>
            <input type="text" class="form-control" id="last_name" name="last_name" required>
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="form-group">
            <label for="phone">Telefonní číslo:</label>
            <input type="tel" class="form-control" id="phone" name="phone" required>
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
