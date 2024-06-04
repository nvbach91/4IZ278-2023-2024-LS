<?php
session_start();

require __DIR__ . '/include/header.php';
require_once __DIR__ . '/validators/HostValidator.php';

if (isset($_SESSION['user_id'])) {
    $_SESSION['basic_info'] = [
        'first_name' => htmlspecialchars($_SESSION['first_name']),
        'last_name' => htmlspecialchars($_SESSION['last_name']),
        'email' => htmlspecialchars($_SESSION['email']),
        'phone' => htmlspecialchars($_SESSION['phone']),
    ];
    header('Location: select-address');
    exit;
}

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $first_name = htmlspecialchars(trim($_POST['first_name']));
    $last_name = htmlspecialchars(trim($_POST['last_name']));
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $phone = htmlspecialchars(trim($_POST['phone']));
 
    $validator = new HostValidator();
    $errors = $validator->validateHost($first_name, $last_name, $email, $phone);

    if (empty($errors)) {
        $_SESSION['basic_info'] = [
            'first_name' => $first_name,
            'last_name' => $last_name,
            'email' => $email,
            'phone' => $phone,
        ];
        header('Location: select-address');
        exit;
    }
}
?>

<div class="container mt-5">
    <h2>Checkout - Základní informace</h2>
    <form action="select-basic-info" method="post">
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
        <button type="submit" class="btn btn-primary">Pokračovat</button>
    </form>
    <div class="mt-3">
        <p>Máte již účet? <a href="login.php">Přihlaste se zde</a></p>
    </div>
</div>

<?php require __DIR__ . '/include/footer.php'; ?>
