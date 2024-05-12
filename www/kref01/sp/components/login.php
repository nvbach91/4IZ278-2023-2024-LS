<!-- TODO php logic -->

<form class="form-signup" method="POST" action="<?php echo $_SERVER['PHP_SELF'] ?>">
    <div class="headline">Login</div>
    <?php if ($showLoginSuccessMessage): ?>
        <div class="form-success">
            <p><?php echo $loginSuccessMessage;?></p>
        </div>
    <?php elseif ($showRegistrationSuccessMessage): ?>
        <div class="form-success">
            <p><?php echo $registrationSuccessMessage;?></p>
        </div>
    <?php elseif ($showLoginErrorMessage): ?>
        <div class="form-errors">
            <p><?php echo $loginErrorMessage;?></p>
        </div>
    <?php endif;?>
    
    <div class="form-group">
        <label>Email</label>
        <input class="form-control" name="email" placeholder="e.g. example@gmail.com" value="<?php echo isset($email) ? $email : '' ?>">
    </div>
    <div class="form-group">
        <label>Password</label>
        <input class="form-control" type="password" name="password" value="">
    </div>
    </div>
    <button class="btn btn-primary" type="submit">
        <p>Submit</p>
    </button>
</form>