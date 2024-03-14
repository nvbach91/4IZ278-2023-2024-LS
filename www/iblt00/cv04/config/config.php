<?php

//delimiter used in CSVs
define('DELIMITER', ',');

//database location
define('DB_USERS', __DIR__ . '/../database//users.db');

//email used for sending emails from server
define('SERVER_EMAIL_FROM', 'iblt00');

//register page
define('PAGE_REGISTER', './register.php');

//login page
define('PAGE_LOGIN', './login.php');

$emailSender = SERVER_EMAIL_FROM . '@vse.cz';

//base email header 
$headers = array(
    'MIME-Version' => '1.0',
    'Content-type' => 'text/html; charset=utf-8',
    'From' => $emailSender,
    'Reply-To' => $emailSender,
    'X-Mailer' => 'PHP/' . phpversion()
);

//global for accessibility from other locations
global $headers;
