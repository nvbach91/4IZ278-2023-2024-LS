<?php if (!empty($errors)) : ?>
    <div class="alert alert-danger"><strong>Following errors occured:</strong><br>
        <?php foreach ($errors as $error) : ?>
            <?php echo $error; ?><br><br>
        <?php endforeach; ?>
    </div>
<?php endif; ?>
<?php if (isset($name) && empty($errors)) : ?>
    <div class="alert alert-success"><strong>Form submission success! E-mail sent.</strong><br></div>
<?php endif; ?>
<form class="form-signup" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <div class="form-group">
        <label>Full name</label>
        <input class="form-control" name="name" value="<?php echo isset($name) ? $name : "" ?>">
        <div class="form-text">e.g. Luke Skywalker</div>
    </div>
    <div class="form-group">
        <label>Gender</label>
        <select name="gender" class="form-select">
            <option <?php echo isset($gender) && $gender == "N" ? 'selected' : "" ?> value="N">Neutral</option>
            <option <?php echo isset($gender) && $gender == "F" ? 'selected' : "" ?> value="F">Female</option>
            <option <?php echo isset($gender) && $gender == "M" ? 'selected' : "" ?> value="M">Male</option>
        </select>
    </div>
    <div class="form-group">
        <label>Email</label>
        <input class="form-control" name="email" value="<?php echo isset($email) ? $email : "" ?>">
        <div class="form-text">e.g. luke.skywalker@gmail.com</div>
    </div>
    <div class="form-group">
        <label>Phone</label>
        <input class="form-control" name="phone" value="<?php echo isset($phone) ? $phone : "" ?>">
        <div class="form-text">e.g. +420 608 928 102</div>
    </div>
    <div class="form-group">
        <label>Avatar URL</label>
        <?php if (isset($name) && empty($errors)) : ?>
            <img src="<?php echo isset($avatar) ? $avatar : "" ?>" alt="Avatar" style="width: 60px; height: 60px; border-radius: 50%; margin-left: 15px">
        <?php endif; ?>
        <input class="form-control" name="avatar" value="<?php echo isset($avatar) ? $avatar : "" ?>">
        <div class="form-text">e.g. https://lumiere-a.akamaihd.net/v1/images/luke-skywalker-main_7ffe21c7.jpeg</div>
    </div>
    <div class="form-group">
        <label>Deck name <span style="color: #ff0000">*</span></label>
        <input class="form-control" name="deck-name" value="<?php echo isset($deckName) ? $deckName : "" ?>">
        <div class="form-text">e.g. TheUltimateCarddeckWeapon V3</div>
    </div>
    <div class="form-group">
        <label>Number of cards in deck <span style="color: #ff0000">*</span></label>
        <input class="form-control" name="deck-count" value="<?php echo isset($deckCount) ? $deckCount : "" ?>">
        <div class="form-text">e.g. 32</div>
    </div>

    <button class="btn btn-primary mt-3" type="submit">Submit</button>
</form>