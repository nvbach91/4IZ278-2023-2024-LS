<?php session_status() === PHP_SESSION_NONE ? session_start() : null; ?>

<?php

$displayErrors = false;

if ($displayErrors) {
    ini_set('display_errors', 1);
    error_reporting(E_ALL);
} else {
    ini_set('display_errors', 0);
    error_reporting(0);
}
