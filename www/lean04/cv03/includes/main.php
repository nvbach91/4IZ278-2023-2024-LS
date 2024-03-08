<?php require "handlers/form.php"; ?>

<main>
    <form class="form-signup" method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
        <h1>Sign Up</h1>

        <div>
            <?php if (isset($successMessage)) : ?>
                <h2 class="form-success"><?php echo $successMessage; ?></h2>
            <?php endif; ?>

            <?php if (!empty($errors)) : ?>
                <div class="form-errors">
                    <?php foreach ($errors as $error) : ?>
                        <p class="form-error"><?php echo $error; ?></p>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>

        <div class="form-group">
            <label>Name*</label>
            <input class="form-control" name="name" value="<?php echo isset($name) ? $name : '' ?>">
        </div>
        </div>
        <div class="form-group">
            <label>Gender*</label>
            <select name="gender">
                <option <?php echo isset($gender) && $gender == 'F' ? 'selected' : ''; ?> value="F">Female</option>
                <option <?php echo isset($gender) && $gender == 'M' ? 'selected' : ''; ?> value="M">Male</option>
            </select>
        </div>
        <div class="form-group">
            <label>Email*</label>
            <input class="form-control" name="email" value="<?php echo isset($email) ? $email : '' ?>">
        </div>
        <div class="form-group">
            <label>Phone*</label>
            <input class="form-control" name="phone" value="<?php echo isset($phone) ? $phone : '' ?>">
        </div>
        <div class="form-group">
            <label>Avatar URL*</label>
            <input class="form-control" name="avatar" value="<?php echo isset($avatar) ? $avatar : '' ?>">
        </div>
        <?php if (isset($avatar)) : ?>
            <div class="form-group">
                <label>Avatar</label>
                <img src="<?php echo $avatar; ?>" alt="Avatar">
            </div>
        <?php endif; ?>
        <div class="form-group">
            <label>Deck name*</label>
            <input class="form-control" name="deckName" value="<?php echo isset($deckName) ? $deckName : '' ?>">
        </div>
        <div class="form-group">
            <label>No. of cards*</label>
            <input class="form-control" name="numberOfCards" value="<?php echo isset($numberOfCards) ? $numberOfCards : '' ?>">
        </div>
        <button class="btn btn-primary" type="submit">Submit</button>
    </form>
</main>