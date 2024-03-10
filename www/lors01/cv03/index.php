<?php
require_once './components/header.php';
?>

<?php
// Define variables and initialize with empty values
$name = $email = $phone = $gender = $avatar = $deck_name = $deck_count = "";
$name_err = $email_err = $phone_err = $gender_err = $avatar_err = $deck_name_err = $deck_count_err = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate name
    if (empty(trim($_POST["name"]))) {
        $name_err = "Please enter your name.";
    } else {
        $name = trim($_POST["name"]);
    }

    // Validate email
    if (empty(trim($_POST["email"]))) {
        $email_err = "Please enter your email.";
    } else {
        $email = trim($_POST["email"]);
    }

    // Validate phone
    if (empty(trim($_POST["phone"]))) {
        $phone_err = "Please enter your phone number.";
    } else {
        $phone = trim($_POST["phone"]);
    }

    // Validate gender
    if (empty(trim($_POST["gender"]))) {
        $gender_err = "Please select your gender.";
    } else {
        $gender = trim($_POST["gender"]);
    }

    // Validate avatar URL
    if (empty(trim($_POST["avatar"]))) {
        $avatar_err = "Please enter your avatar URL.";
    } else {
        $avatar = trim($_POST["avatar"]);
    }

    // Validate deck name
    if (empty(trim($_POST["deck_name"]))) {
        $deck_name_err = "Please enter the name of your deck.";
    } else {
        $deck_name = trim($_POST["deck_name"]);
    }

    // Validate deck count
    if (empty(trim($_POST["deck_count"]))) {
        $deck_count_err = "Please enter the number of cards in your deck.";
    } else {
        $deck_count = trim($_POST["deck_count"]);
        if (!is_numeric($deck_count) || $deck_count <= 0) {
            $deck_count_err = "Please enter a valid number of cards.";
        }
    }

    
    // Check if all errors are empty
    if (empty($name_err) && empty($email_err) && empty($phone_err) && empty($avatar_err) && empty($deck_name_err) && empty($deck_count_err)) {
        // Send an email or perform other success actions here
        echo '<div class="alert alert-success">Registration successful!</div>';
    }
}
?>

<div class="container">
    <h2>Register for Card Game Tournament</h2>
    <form class="form-signup" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <div class="form-group">
            <label>Name*</label>
            <input class="form-control <?php echo (!empty($name_err)) ? 'is-invalid' : ''; ?>" name="name" value="<?php echo $name; ?>">
            <span class="invalid-feedback"><?php echo $name_err;?></span>
        </div>
        <div class="form-group">
            <label>Email*</label>
            <input type="email" class="form-control <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>" name="email" value="<?php echo $email; ?>">
            <span class="invalid-feedback"><?php echo $email_err;?></span>
        </div>
        <div class="form-group">
            <label>Phone*</label>
            <input type="text" class="form-control <?php echo (!empty($phone_err)) ? 'is-invalid' : ''; ?>" name="phone" value="<?php echo $phone; ?>">
            <span class="invalid-feedback"><?php echo $phone_err;?></span>
        </div>
        <div class="form-group">
            <label>Gender*</label>
            <select class="form-control <?php echo (!empty($gender_err)) ? 'is-invalid' : ''; ?>" name="gender">
                <option value="">Select Gender</option>
                <option value="Male" <?php echo $gender == "Male" ? 'selected' : ''; ?>>Male</option>
                <option value="Female" <?php echo $gender == "Female" ? 'selected' : ''; ?>>Female</option>
            </select>
            <span class="invalid-feedback"><?php echo $gender_err;?></span>
        </div>
        <div class="form-group">
            <label>Avatar URL*</label>
            <img id="target-avatar" src="<?php echo $avatar; ?>" alt="Profile Image" style="<?php echo !empty($avatar) ? 'display:block;' : 'display:none;'; ?> width: 100px; height: auto; margin-bottom: 10px;">
            <input type="url" class="form-control <?php echo (!empty($avatar_err)) ? 'is-invalid' : ''; ?>" id="avatar" name="avatar" value="<?php echo $avatar; ?>" oninput="showImage()">
            <span class="invalid-feedback"><?php echo $avatar_err;?></span>
        </div>
        <div class="form-group">
            <label>Deck Name*</label>
            <input class="form-control <?php echo (!empty($deck_name_err)) ? 'is-invalid' : ''; ?>" name="deck_name" value="<?php echo $deck_name; ?>">
            <span class="invalid-feedback"><?php echo $deck_name_err;?></span>
        </div>
        <div class="form-group">
            <label>Number of Cards in Deck*</label>
            <input type="number" class="form-control <?php echo (!empty($deck_count_err)) ? 'is-invalid' : ''; ?>" name="deck_count" value="<?php echo $deck_count; ?>">
            <span class="invalid-feedback"><?php echo $deck_count_err;?></span>
        </div>
        <button class="btn btn-primary" type="submit">Submit</button>
    </form>
</div>

<?php
require_once './components/footer.php';
?>
