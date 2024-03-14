<?php
include 'includes/head.php';
require 'functions.php';
$validProfilePictureUrl = false;
if(!empty($_POST)){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm_password'];
    $errorMessages = [];
    if (empty($_POST['name']) || !strpos(trim($_POST['name']),' ')){
        $errorMessages[] = 'Please enter your full name';
    }
    if (empty($_POST['email']) || !filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)){
        $errorMessages[] = 'Please enter a valid email';
    }
    if (empty($_POST['password'])){
        $errorMessages[] = 'Please enter a password';
    }
    if (empty($_POST['confirm_password']) || $_POST['confirm_password'] !== $_POST['password']){
        $errorMessages[] = 'Please confirm your password. Confirm password must match password';
    }
    if (!empty($errorMessages)){
        require 'includes/error.php';
    }
    else{
        if(registerNewUser($email, $name, $password)){
            header("Location: login.php?email=$email");
        }
        else{
            $errorMessages[] = 'User already exists';
            require 'includes/error.php';
        }
    }

}
require 'includes/form.php';

include 'includes/foot.php';
?>
