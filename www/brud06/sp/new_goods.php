<?php
session_start();

// Unset the blacksmith items from the session
unset($_SESSION['blacksmith_items']);

require_once 'db/ItemsDB.php';

$itemsDB = new ItemsDB();

// Generate 6 new random items and store them in the session
$_SESSION['blacksmith_items'] = $itemsDB->getRandomItems(6);

// Redirect the player back to the BlacksmithDisplay
header('Location: ./components/BlacksmithDisplay.php');
exit();