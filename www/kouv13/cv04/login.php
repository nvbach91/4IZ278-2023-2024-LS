<?php
if (isset($_GET['email'])) {
    $email = htmlspecialchars(trim($_GET['email']));
}

require('./components/auth.php');
include('./components/head.php');
require('./components/loginBody.php');
