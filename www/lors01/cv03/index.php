<?php
require_once './components/header.php';
?>

<?php
// Define variables and initialize with empty values
$inputs = [
    'name' => '',
    'email' => '',
    'phone' => '',
    'gender' => '',
    'avatar' => '',
    'deck_name' => '',
    'deck_count' => ''
];

$errors = [];
$validation_messages = [
    'name' => 'Please enter your name.',
    'email' => 'Please enter your email.',
    'phone' => 'Please enter your phone number.',
    'gender' => 'Please select your gender.',
    'avatar' => 'Please enter your avatar URL.',
    'deck_name' => 'Please enter the name of your deck.',
    'deck_count' => 'Please enter the number of cards in your deck.'
];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    foreach ($inputs as $key => $value) {
        if (empty(trim($_POST[$key]))) {
            $errors[$key] = $validation_messages[$key];
        } else {
            $inputs[$key] = trim($_POST[$key]);
            if ($key == 'deck_count' && (!is_numeric($inputs[$key]) || $inputs[$key] <= 0)) {
                $errors[$key] = 'Please enter a valid number of cards.';
            }
        }
    }

    // Check if all errors are empty
    if (empty(array_filter($errors))) {
        echo '<div class="alert alert-success">Registration successful!</div>';
    }
}
?>
<div class="container">
    <h2>Register for Card Game Tournament</h2>
    <form class="form-signup" method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
        <?php foreach ($inputs as $key => $value): ?>
            <div class="form-group">
                <label><?php echo ucfirst(str_replace('_', ' ', $key)); ?>*</label>
                <?php if ($key == 'gender'): ?>
                    <select class="form-control <?php echo (!empty($errors[$key])) ? 'is-invalid' : ''; ?>" name="<?php echo $key; ?>">
                        <option value="">Select Gender</option>
                        <option value="Male" <?php echo $inputs[$key] == "Male" ? 'selected' : ''; ?>>Male</option>
                        <option value="Female" <?php echo $inputs[$key] == "Female" ? 'selected' : ''; ?>>Female</option>
                    </select>
                <?php elseif ($key == 'avatar'): ?>
                    <img id="target-avatar" src="<?php echo htmlspecialchars($inputs[$key]); ?>" alt="Profile Image" style="<?php echo !empty($inputs[$key]) ? 'display:block;' : 'display:none;'; ?> width: 100px; height: auto; margin-bottom: 10px;">
                    <input type="url" class="form-control <?php echo (!empty($errors[$key])) ? 'is-invalid' : ''; ?>" name="<?php echo $key; ?>" value="<?php echo htmlspecialchars($inputs[$key]); ?>" oninput="showImage()">
                <?php else: ?>
                    <input type="<?php echo $key == 'email' ? 'email' : ($key == 'deck_count' ? 'number' : 'text'); ?>" class="form-control <?php echo (!empty($errors[$key])) ? 'is-invalid' : ''; ?>" name="<?php echo $key; ?>" value="<?php echo htmlspecialchars($inputs[$key]); ?>">
                <?php endif; ?>
                <span class="invalid-feedback"><?php echo htmlspecialchars($errors[$key] ?? ''); ?></span>
            </div>
        <?php endforeach; ?>
        <button class="btn btn-primary" type="submit">Submit</button>
    </form>
</div>

<?php
require_once './components/footer.php';
?>