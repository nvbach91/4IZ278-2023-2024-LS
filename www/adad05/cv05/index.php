<?php

require 'classes/PlayersDB.php';
require 'classes/TeamsDB.php';
require 'classes/MatchesDB.php';

$playersDB = new PlayersDB();
$teamsDB = new TeamsDB();
$matchesDB = new MatchesDB();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Class Structure</title>
</head>

<body>
    <h1>Test of created classes and methods:</h1>
    <h2>Singleton class DatabaseConnection:</h2>
    <div>
        <ul>
            <li><?php DatabaseConnection::getPDOConnectionParameters(); ?></li>
        </ul>
    </div>
    <h2>PlayersDB class and its CRUD methods:</h2>
    <div>
        <ul>
            <li><?php $playersDB->create("data"); ?></li>
            <li><?php $playersDB->find("query"); ?></li>
            <li><?php $playersDB->update("query", "data"); ?></li>
            <li><?php $playersDB->delete("query"); ?></li>
        </ul>
    </div>
    <h2>TeamsDB class and its CRUD methods:</h2>
    <div>
        <ul>
            <li><?php $teamsDB->create("data"); ?></li>
            <li><?php $teamsDB->find("query"); ?></li>
            <li><?php $teamsDB->update("query", "data"); ?></li>
            <li><?php $teamsDB->delete("query"); ?></li>
        </ul>
    </div>
    <h2>MatchesDB class and its CRUD methods:</h2>
    <div>
        <ul>
            <li><?php $matchesDB->create("data"); ?></li>
            <li><?php $matchesDB->find("query"); ?></li>
            <li><?php $matchesDB->update("query", "data"); ?></li>
            <li><?php $matchesDB->delete("query"); ?></li>
        </ul>
    </div>
</body>

</html>