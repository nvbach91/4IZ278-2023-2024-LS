
<?php 
require "./forms/form.php";
?>

<div class="form-container">
    <div class="message-container">
        <?php if (isset($succesMessage)): ?>
            <h2 class="message-header"><?php echo $succesMessage; ?></h2>
        <?php endif ?>

        <?php if (!empty($errors)): ?>
            <div class="error-container">
                <?php foreach ($errors as $error): ?>
                    <p class="form-error"><?php echo $error; ?></p>
                <?php endforeach ?>
            </div>
        <?php endif ?>
    </div>

    <form class="form-signup" method="POST" action="<?php echo $_SERVER['PHP_SELF']?>">
        <div class="form-group">
            <label>Name*</label>
            <input class="form-control" name="name" value="<?php echo isset($name) ? $name : "" ?>">
        </div>
        <div class="form-group">
            <label>Gender*</label>
            <select name="gender">
                <option <?php echo isset($gender) && $gender == "" ? "selected" : ""; ?> value=""></option>
                <option <?php echo isset($gender) && $gender == "F" ? "selected" : ""; ?> value="F">Female</option>
                <option <?php echo isset($gender) && $gender == "M" ? "selected" : ""; ?> value="M">Male</option>
            </select>
        </div>
        <div class="form-group">
            <label>Email*</label>
            <input class="form-control" name="email" value="<?php echo isset($email) ? $email : "" ?>">
        </div>
        <div class="form-group">
            <label>Phone*</label>
            <input class="form-control" name="phone" value="<?php echo isset($phone) ? $phone : "" ?>">
        </div>
        <div class="form-group">
            <label>Avatar URL*</label>
            <input class="form-control" name="avatar" value="<?php echo isset($avatar) ? $avatar : "" ?>">
            <?php if (isset($avatar) && filter_var($avatar, FILTER_VALIDATE_URL)): ?>
                <img class="avatar" src=<?php echo $avatar; ?>>
            <?php endif ?>
        </div>
        <div class="form-group">
            <label>Card package name*</label>
            <input class="form-control" name="package_name" value="<?php echo isset($package_name) ? $package_name : "" ?>">
        </div>
        <div class="form-group">
            <label>Amount of cards in package*</label>
            <input class="form-control" name="amount_of_cards" value="<?php echo isset($amount_of_cards) ? $amount_of_cards : "" ?>">
        </div>
        <button class="btn btn-primary" type="submit">Submit</button>
    </form>

</div>