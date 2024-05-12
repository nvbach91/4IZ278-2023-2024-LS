<?php

function validateEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL) && strlen($email) > 0 && strlen($email) <= 255;
}

function validateStr($name) {
    return strlen($name) > 0 && strlen($name) <= 255;
}

// Zvaliduje ID. Lze použít na ID organizace, služby, skladby, atd.
function validateId($id) {
    return preg_match('/^[1-9]\d*$/', $id);
}

function validatePassword($password) {
    return preg_match('/^(?=.*[A-Z])(?=.*\d).{8,}$/', $password);
}
