<?php
require_once __DIR__ . '/../db/UserDatabase.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location:' .__DIR__ );
    exit;
}

// v session je user id uzivatele, ted ho nacteme z db
$requiredRole = 4;
$usersDB = new UsersDatabase();

// nacte do promenne $user aktualne prihlaseneho usera, bude pristupny z cele aplikace
$result = $usersDB->readUserByIdRole($_SESSION['user_id'], $requiredRole)[0];

if ($result['role'] < 3) {
    header('Location:' .__DIR__ );
    exit;
}

$current_user = $result;

// pokud by v db z nejakeho duvodu user nebyl (treba byl mezitim nejak smazan), tak vymaz session a jdi na prihlaseni
if (!$current_user) {
    session_destroy();
    header('Location: /../index.php');
    exit;
}

?>