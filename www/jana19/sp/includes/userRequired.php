<?php
require_once __DIR__ . '/../db/UserDatabase.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: ./login.php');
    exit;
}

// v session je user id uzivatele, ted ho nacteme z db

$usersDB = new UsersDatabase();

// nacte do promenne $user aktualne prihlaseneho usera, bude pristupny z cele aplikace
$current_user = $usersDB->readUserById($_SESSION['user_id'])[0];

// pokud by v db z nejakeho duvodu user nebyl (treba byl mezitim nejak smazan), tak vymaz session a jdi na prihlaseni
if (!$current_user) {
    session_destroy();
    header('Location: index.php');
    exit;
}

?>