<?php

@session_start();

function allowedRoles($listOfAllowedRoles) {
    if (!isset($_SESSION["role"]) || !in_array($_SESSION["role"], $listOfAllowedRoles)) {
        header('Location: ' . "index.php");
        exit();
    }
}
