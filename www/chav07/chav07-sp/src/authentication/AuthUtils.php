<?php
require_once __DIR__ . "/../database/User.php";

function isAuthenticated(): bool{

    if(isset($_SESSION["user"])){
        return true;
    }
    return false;    
}

enum AuthRole: int{
    case User = 0;
    case Admin = 1;
}

function isAuthorized(AuthRole $level): bool{
    if (!isset($_SESSION["user"])){
        return false;
    }
    $user = $_SESSION["user"];
    if($user->role == $level){
        return true;
    }
    return false;
}

function startSessionIfNone(){
    if(session_status() != PHP_SESSION_ACTIVE){
        session_start();
    }
}
?>