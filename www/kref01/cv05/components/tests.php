<?php
require './classes/DatabaseConnection.php';
require './classes/DatabaseOperations.php';
require './classes/Database.php';

require './classes/PlayersDB.php';
require './classes/MatchesDB.php';
require './classes/TeamsDB.php'; 

$dbCon = DatabaseConnection::getInstance();

$players = new PlayersDB();
$matches = new MatchesDB();
$teams = new TeamsDB();

?>

<h1>Database testing</h1>

<p><?php $dbCon->printConnectionCredentials(); ?></p>

<p><?php $players->create("abcde123") ?></p>
<p><?php $players->find("abcde123") ?></p>
<p><?php $players->update("abcde123") ?></p>
<p><?php $players->create("abcde123") ?></p>

<p><?php $matches->create("abcde123") ?></p>
<p><?php $matches->find("abcde123") ?></p>
<p><?php $matches->update("abcde123") ?></p>
<p><?php $matches->create("abcde123") ?></p>

<p><?php $teams->create("abcde123") ?></p>
<p><?php $teams->find("abcde123") ?></p>
<p><?php $teams->update("abcde123") ?></p>
<p><?php $teams->create("abcde123") ?></p>