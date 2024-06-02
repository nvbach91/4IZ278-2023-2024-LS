<?php
session_start();

require_once __DIR__ . '/db/UsersDB.php';
require_once __DIR__ . '/db/AddressDB.php';

$userDB = new UsersDB();
$addressDB = new AddressDB();
$userId = $_SESSION['user_id'];

// Nejdříve smažeme adresy spojené s uživatelem
$addressDB->deleteByUserId($userId);

// Poté smažeme uživatele
$userDB->delete($userId);

// Zničíme session
session_destroy();

// Přesměrujeme na domovskou stránku
header('Location: index.php');
exit();
?>
