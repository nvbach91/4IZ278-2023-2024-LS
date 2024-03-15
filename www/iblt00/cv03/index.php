<?php require './components/form.php'; ?>

<?php include './includes/header.php'; ?>

<main class="container">
    <h1>Registration Form using PHP validation</h1>
    <div class="form-container">
        <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <?php if ($submittedForm) : ?>
                <div class='alert <?php echo $alertType; ?>'><?php echo implode('<br>', $alertMessages); ?>
                </div>
            <?php endif; ?>
            <div class="form-group">
                <label>Name*</label>
                <input class="form-input<?php echo in_array('name', $invalidInputs) ? ' is-invalid' : '' ?>" name="name" value="<?php echo isset($name) ? $name : ''; ?>">
                <small>Example: John Wick</small>
            </div>
            <div class="form-group">
                <label>Gender*</label>
                <select class="form-input<?php echo in_array('gender', $invalidInputs) ? ' is-invalid' : '' ?>" name="gender">
                    <option value="NA">--- Please Select ---</option>
                    <option value="F" <?php echo isset($gender) && $gender == 'F' ? 'selected' : ''; ?>>Female</option>
                    <option value="M" <?php echo isset($gender) && $gender == 'M' ? 'selected' : ''; ?>>Male</option>
                    <option value="O" <?php echo isset($gender) && $gender == 'O' ? 'selected' : ''; ?>>Other</option>
                </select>
            </div>
            <div class="form-group">
                <label>Email*</label>
                <input class="form-input<?php echo in_array('email', $invalidInputs) ? ' is-invalid' : '' ?>" name="email" value="<?php echo isset($email) ? $email : ''; ?>">
                <small>Example: JohnWicked@mail.com</small>
            </div>
            <div class="form-group">
                <label>Phone*</label>
                <input class="form-input<?php echo in_array('phone', $invalidInputs) ? ' is-invalid' : '' ?>" name="phone" value="<?php echo isset($phone) ? $phone : ''; ?>">
                <small>Example: +420 721 000 355</small>
            </div>
            <div class="form-group">
                <label>Avatar URL*</label>
                <input class="form-input<?php echo in_array('avatarURL', $invalidInputs) ? ' is-invalid' : '' ?>" name="avatarURL" value="<?php echo isset($avatarURL) ? $avatarURL : ''; ?>">
                <small>Example: https://img.buzzfeed.com/buzzfeed-static/complex/images/lisq1ydcedcy00oflhyt/john-wick-chapter-2-image.jpg</small>
            </div>
            <div class="form-group">
                <label>Deck Name*</label>
                <input class="form-input<?php echo in_array('deckName', $invalidInputs) ? ' is-invalid' : '' ?>" name="deckName" value="<?php echo isset($deckName) ? $deckName : ''; ?>">
                <small>Example: Pistol & Knife Deck</small>
            </div>
            <div class="form-group">
                <label>N. of Cards*</label>
                <input class="form-input<?php echo in_array('cardCount', $invalidInputs) ? ' is-invalid' : '' ?>" name="cardCount" value="<?php echo isset($cardCount) ? $cardCount : ''; ?>">
                <small><em><strong>Note: </strong>only decks containing 22-30 cards are permitted</em></small>
            </div>
            <div class="button-submit">
                <button type="submit">Submit</button>
            </div>
        </form>
    </div>

</main>

<?php include './includes/footer.php'; ?>