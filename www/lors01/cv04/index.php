<?php
require_once './components/header.php';
?>

<div class="container">
    <h1>Welcome to the Card Game Tournament</h1>
    <p>Please choose an option:</p>
    <div class="row">
        <div class="col-md-4">
            <a href="registration.php" class="btn btn-primary btn-block">Register</a>
        </div>
        <div class="col-md-4">
            <a href="login.php" class="btn btn-success btn-block">Login</a>
        </div>
        <div class="col-md-4">
            <a href="admin/users.php" class="btn btn-info btn-block">Registered Users</a>
        </div>
    </div>
</div>

<?php
require_once './components/footer.php';
?>