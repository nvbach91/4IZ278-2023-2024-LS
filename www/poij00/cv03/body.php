<body>
<div class="panel"></div>
<div class="container">
    <div class="notifications">
    <?php if (isset($successMessage)):?>
        <h2><?php echo $successMessage ?></h2>
    <?php endif; ?>
    <?php if (!empty($errors)): ?>
        <div class="form-errors">
            <?php foreach($errors as $error): ?>
                <p><?php echo $error; ?></p>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
    </div>
<form class="form-signup" method="POST" action="<?php echo $_SERVER['PHP_SELF']?>">
    <div class="form-group">
        <label>Name*</label>
        <input class="form-control" name="name" value="<?php echo isset($name) ? $name : '';?>">
    </div>
    <div class="form-group">
        <label>Gender</label>
        <select name="gender" id="" class="form-control">
            <option <?php echo isset($gender) && $gender == '' ? 'selected' : ''; ?> value=""></option>
            <option <?php echo isset($gender) && $gender == 'Male' ? 'selected' : ''; ?> value="Male">Male</option>
            <option <?php echo isset($gender) && $gender == 'Female' ? 'selected' : ''; ?> value="Female">Female</option>
        </select>
    </div>
    <div class="form-group">
        <label>Email*</label>
        <input class="form-control" name="email" value="<?php echo isset($email) ? $email : '';?>">
    </div>
    <div class="form-group">
        <label>Phone*</label>
        <input class="form-control" name="phone" value="<?php echo isset($phone) ? $phone : '';?>">
    </div>
    <div class="form-group">
        <label>Avatar URL*</label>
        <input class="form-control" name="avatar" value="<?php echo isset($avatar) ? $avatar : '';?>">
    </div>
    <div class="form-group">
        <label>Card game</label>
        <select name="card-game" id="" class="form-control">
            <option <?php echo isset($cardGame) && $cardGame == '' ? 'selected' : ''; ?> value=""></option>
            <option <?php echo isset($cardGame) && $cardGame == 'Poker' ? 'selected' : ''; ?> value="Poker">Poker</option>
            <option <?php echo isset($cardGame) && $cardGame == 'Canasta' ? 'selected' : ''; ?> value="Canasta">Canasta</option>
            <option <?php echo isset($cardGame) && $cardGame == 'Bridge' ? 'selected' : ''; ?> value="Bridge">Bridge</option>
            <option <?php echo isset($cardGame) && $cardGame == 'Euchre' ? 'selected' : ''; ?> value="Euchre">Euchre</option>
        </select>
    </div>
    <div class="form-group">
        <label>Number of cards</label>
        <select name="no-cards" id="" class="form-control">
            <option <?php echo isset($noCards) && $noCards == '' ? 'selected' : ''; ?> value=""></option>
            <option <?php echo isset($noCards) && $noCards == '24' ? 'selected' : ''; ?> value="24">24</option>
            <option <?php echo isset($noCards) && $noCards == '52' ? 'selected' : ''; ?> value="52">52</option>
        </select>
    </div>
    <div class="button-area">
        <button class="btn btn-primary" type="submit">Submit</button>
    </div>
    
</form>
</div>
