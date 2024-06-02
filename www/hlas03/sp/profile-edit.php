<?php require __DIR__ . '/include/profile-navigation.php'; ?>
<?php

require_once __DIR__ . '/db/UsersDB.php';
require_once __DIR__ . '/validators/UserValidator.php';

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userId = $_SESSION['user_id'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];

    $validator = new UserValidator();
    $errors = $validator->validateProfileEdit($first_name, $last_name, $email, $phone, $userId, $password);

    if (empty($errors)) {
        $userDB = new UsersDB(); 
        $result = $userDB->updateUser($userId, $first_name, $last_name, $email, $phone);

        if ($result) {
            $_SESSION['first_name'] = $first_name;
            $_SESSION['last_name'] = $last_name;
            $_SESSION['email'] = $email;
            $_SESSION['phone'] = $phone;

            header('Location: profile.php');
            exit;
        } else {
            $errors[] = "Aktualizace profilu selhala.";
        }
    }
}
?>

<div class="container mt-5">
    <h2>Upravit profil</h2>
    <form action="profile-edit" method="post">
        <?php if (!empty($errors)): ?>
            <div class="alert alert-danger">
                <?php foreach ($errors as $error): ?>
                    <p><?php echo htmlspecialchars($error); ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
        <div class="form-group">
            <label for="first_name">Jméno:</label>
            <input type="text" class="form-control" id="first_name" name="first_name" value="<?php echo htmlspecialchars($_SESSION['first_name']); ?>" required>
        </div>
        <div class="form-group">
            <label for="last_name">Příjmení:</label>
            <input type="text" class="form-control" id="last_name" name="last_name" value="<?php echo htmlspecialchars($_SESSION['last_name']); ?>" required>
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($_SESSION['email']); ?>" required>
        </div>
        <div class="form-group">
            <label for="phone">Telefonní číslo:</label>
            <input type="tel" class="form-control" id="phone" name="phone" value="<?php echo htmlspecialchars($_SESSION['phone']); ?>" required>
        </div>
        <div class="form-group">
            <label for="password">Heslo:</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <button type="submit" class="btn btn-primary">Uložit změny</button>
        <a href="change-password.php" class="btn btn-secondary">Změnit heslo</a>
    </form>
</div>

<?php require __DIR__ . '/include/footer.php'; ?>
