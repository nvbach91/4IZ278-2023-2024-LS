<?php
session_start();
require_once 'db/QuestsDB.php';

// Check if quest_id is provided
if (!isset($_POST['quest_id'])) {
    die('No quest selected');
}

// Get the quest from the database
$questsDB = new QuestsDB();
$quest = $questsDB->getQuestById($_POST['quest_id']);

// Check if the quest exists and has a monster_id
if ($quest === false || !isset($quest['monster_id'])) {
    die('Invalid quest or no monster associated with quest');
}

// Store quest_id and monster_id in session
$_SESSION['accepted_quest_id'] = $_POST['quest_id'];
$_SESSION['monster_id'] = $quest['monster_id'];

// Redirect back to quests page
header('Location: components/EncounterDisplay.php');
exit;