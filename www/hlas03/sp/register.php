<?php require __DIR__ . '/include/header.php'; ?>
<?php

require_once __DIR__ . '/db/UsersDB.php';

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Kontrola shody hesel
    if ($password !== $confirm_password) {
        $errors[] = "Passwords do not match.";
    }

    // Kontrola minimální délky hesla
    if (strlen($password) < 5) {
        $errors[] = "Password must be at least 5 characters long.";
    }

    // Kontrola formátu telefonního čísla
    if (!preg_match('/^\+?[1-9]\d{1,14}$/', $phone)) {
        $errors[] = "Invalid phone number format.";
    }

    $user = new UsersDB();
    
    // Kontrola unikátnosti emailu
    if ($user->findByEmail($email)) {
        $errors[] = "Email already registered.";
    }

    // Kontrola unikátnosti telefonního čísla
    if ($user->findByPhone($phone)) {
        $errors[] = "Phone number already registered.";
    }

    // Pokud nejsou žádné chyby, vytvořte uživatele
    if (empty($errors)) {
        $result = $user->create($first_name, $last_name, $email, $phone, $password);

        if ($result) {
            header('Location: login.php');
            exit;
        } else {
            $errors[] = "Registration failed.";
        }
    }
}
?>

<div class="container">
    <h2 class="mt-5">Registration</h2>
    <form method="post">
        <?php if (!empty($errors)): ?>
            <div class="alert alert-danger">
                <?php foreach ($errors as $error): ?>
                    <p><?php echo htmlspecialchars($error); ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
        <div class="form-group">
            <label for="first_name">First name:</label>
            <input type="text" class="form-control" id="first_name" name="first_name" required>
        </div>
        <div class="form-group">
            <label for="last_name">Last name:</label>
            <input type="text" class="form-control" id="last_name" name="last_name" required>
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="form-group">
            <label for="phone">Phone Number:</label>
            <input type="tel" class="form-control" id="phone" name="phone" required>
        </div>
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <div class="form-group">
            <label for="confirm_password">Confirm Password:</label>
            <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
        </div>
        <button type="submit" class="btn btn-primary">Register</button>
    </form>
</div>

<?php require __DIR__ . '/include/footer.php'; ?>
