<?php
require_once './components/header.php';
require_once './functions.php';

// Define variables and initialize with empty values
$inputs = [
    'name' => '',
    'email' => '',
    'password' => '',
    'confirm_password' => ''
];
$errors = [];
$validation_messages = [
    'name' => 'Please enter your name.',
    'email' => 'Please enter a valid email address.',
    'password' => 'Please enter a password.',
    'confirm_password' => 'Please confirm your password.'
];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    foreach ($inputs as $key => $value) {
        if (empty(trim($_POST[$key]))) {
            $errors[$key] = $validation_messages[$key];
        } else {
            $inputs[$key] = trim($_POST[$key]);
            if ($key == 'email' && !filter_var($inputs[$key], FILTER_VALIDATE_EMAIL)) {
                $errors[$key] = 'Please enter a valid email address.';
            }
        }
    }

    if ($inputs['password'] !== $inputs['confirm_password']) {
        $errors['confirm_password'] = 'Passwords do not match.';
    }

    if (empty(array_filter($errors))) {
        $result = registerNewUser($inputs);
        if ($result['success']) {
            $to = $inputs['email'];
            $subject = 'Registration Successful';
            $message = 'Thank you for registering!';
            $headers = 'From: webmaster@example.com' . "\r\n" .
                'Reply-To: webmaster@example.com' . "\r\n" .
                'X-Mailer: PHP/' . phpversion();

            mail($to, $subject, $message, $headers);
            header("Location: login.php?email=" . urlencode($inputs['email']));
            exit;
        } else {
            $errors['email'] = $result['message'];
        }
    }
}


function registerNewUser($data) {
    $users = fetchUsers();
    if (isset($users[$data['email']])) {
        return ['success' => false, 'message' => 'Email already exists.'];
    } else {
        $file = fopen('users.db', 'a');
        fputcsv($file, [$data['name'], $data['email'], $data['password']], ';');
        fclose($file);
        return ['success' => true];
    }
}
?>

<div class="container">
    <h2>Register</h2>
    <form class="form-signup" method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
        <?php foreach ($inputs as $key => $value): ?>
            <div class="form-group">
                <label><?php echo ucfirst(str_replace('_', ' ', $key)); ?>*</label>
                <?php if ($key == 'password' || $key == 'confirm_password'): ?>
                    <input type="password" class="form-control <?php echo (!empty($errors[$key])) ? 'is-invalid' : ''; ?>" name="<?php echo $key; ?>" value="<?php echo htmlspecialchars($inputs[$key]); ?>">
                <?php else: ?>
                    <input type="text" class="form-control <?php echo (!empty($errors[$key])) ? 'is-invalid' : ''; ?>" name="<?php echo $key; ?>" value="<?php echo htmlspecialchars($inputs[$key]); ?>">
                <?php endif; ?>
                <span class="invalid-feedback"><?php echo htmlspecialchars($errors[$key] ?? ''); ?></span>
            </div>
        <?php endforeach; ?>
        <button class="btn btn-primary" type="submit">Register</button>
    </form>
</div>

<?php
require_once './components/footer.php';
?>