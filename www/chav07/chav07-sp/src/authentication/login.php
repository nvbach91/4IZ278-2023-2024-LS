<?php

require_once __DIR__ . "/../database/dbconnection.php";
require_once __DIR__ . "/../database/UserRepository.php";
require_once __DIR__ . "/../authentication/AuthUtils.php";
require_once __DIR__ . "/../config.php";



if(!isset($_POST["loginEmail"]) || !isset($_POST["loginPassword"])){
    exit("Invalid email or password");
}

$sanitizedEmail = filter_input(INPUT_POST, "loginEmail", FILTER_SANITIZE_EMAIL);
$password = htmlspecialchars($_POST["loginPassword"]);

if(filter_var($sanitizedEmail, FILTER_VALIDATE_EMAIL) === false){
    exit("Invalid email address");
}
$password_regex =  "/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$ %^&*_-]).{8,}$/";

if(!preg_match($password_regex, $password)){
    exit("Invalid email or password");
}



$repository = new UserRepository();

$user = $repository->getUserByEmail($sanitizedEmail);

password_hash($user->password, PASSWORD_DEFAULT);

if($user == null){
    exit("User doesn't exist!");
}

if($user->password && password_verify($password, $user->password)){
    // startSessionIfNone();
    session_start();
    $_SESSION["user"] = $user;
    header("Location: " . BASE_URL . "/" );
}
// header("Location: " . BASE_URL . "/login.php" );



?>