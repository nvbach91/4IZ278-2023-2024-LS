<?php
require_once './classes/UsersDB.php';

$first_name = '';
$middle_name = '';
$last_name = '';
$email = '';
$date_of_birth = '';
$role = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $first_name = $_POST['first_name'];
    $middle_name = $_POST['middle_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $date_of_birth = $_POST['date_of_birth'];
    $role = $_POST['role'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    $usersDB = new UsersDB();

    // Check if email is already used
    if ($usersDB->emailExists($email)) {
        $error = "Email is already in use.";
    } elseif ($password !== $confirm_password) {
        $error = "Passwords do not match.";
    } else if (!preg_match('/[A-Z]/', $password) || !preg_match('/[a-z]/', $password)) {
        $error = "Password must contain at least one uppercase letter and one lowercase letter.";
    } else if (strlen($password) < 8) {
        $error = "Password must be at least 8 characters long.";
    } else if ($role === 'admin') {
        $error = "You cannot register as admin.";
    } else {
        $hashed_password = hash('sha256', $password);
        // password_hash
        
        $user_id = $usersDB->create([
            'first_name' => $first_name,
            'middle_name' => $middle_name,
            'last_name' => $last_name,
            'email' => $email,
            'password' => $hashed_password,
            'date_of_birth' => $date_of_birth,
            'role' => $role
        ]);

        if ($user_id) {
            header("Location: ./login.php?registered=success");
            exit;
        } else {
            $error = "Registration failed. Please try again.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register</title>
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>
    <?php if (isset($error)): ?>
        <div class="error-banner"><?php echo htmlspecialchars($error); ?></div>
    <?php endif; ?>
    <div class="login-container">
        <h1>Register</h1>
        <form method="POST" action="registration.php">
            <label for="first_name">First Name:</label>
            <input type="text" id="first_name" name="first_name" minlength="2" value="<?php echo htmlspecialchars($first_name); ?>" required>

            <label for="middle_name">Middle Name:</label>
            <input type="text" id="middle_name" name="middle_name" value="<?php echo htmlspecialchars($middle_name); ?>">

            <label for="last_name">Last Name:</label>
            <input type="text" id="last_name" name="last_name" value="<?php echo htmlspecialchars($last_name); ?>" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required>

            <label for="date_of_birth">Date of Birth:</label>
            <input type="date" id="date_of_birth" name="date_of_birth" value="<?php echo htmlspecialchars($date_of_birth); ?>" required>

            <label for="role">Role:</label>
            <select id="role" name="role" required>
                <option value="student" <?php if ($role === 'student') echo 'selected'; ?>>Student</option>
                <option value="teacher" <?php if ($role === 'teacher') echo 'selected'; ?>>Teacher</option>
                <option value="parent" <?php if ($role === 'parent') echo 'selected'; ?>>Parent</option>
            </select>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>

            <label for="confirm_password">Confirm Password:</label>
            <input type="password" id="confirm_password" name="confirm_password" required>
            
            <button type="submit">Register</button>
        </form>
        <p>Already have an account? <a href="login.php">Login here</a></p>
    </div>
</body>
</html>
