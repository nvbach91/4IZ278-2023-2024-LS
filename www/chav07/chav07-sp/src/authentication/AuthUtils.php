<?php

// require_once __DIR__ . "/../database/dbconnection.php";


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

function requireAuhtorization(AuthRole $level): bool{
    if(isset($_SESSION["user"]) && $_SESSION["user"]->role == $level){
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