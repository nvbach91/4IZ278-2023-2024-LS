<?php
require "Database.php";
require "tables/PlayersDB.php";
require "tables/TeamsDB.php";
require "tables/MatchesDB.php";
$query = "example";
$data = "example";
$playersDB = new PlayersDB();
$teamsDB = new TeamsDB();
$matchesDB = new MatchesDB();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Database</title>
</head>
<body>
    <h1> Players </h1>
    <ul>
        <li>
            <?php $playersDB->create($data); ?>
        </li>  
        <li>
            <?php $playersDB->find($query); ?>
        </li>
        <li>
            <?php $playersDB->update($query, $data); ?>
        </li>
        <li>
            <?php $playersDB->delete($query); ?>
        </li>
    </ul>
    <h1> Teams </h1>
    <ul>
        <li>
            <?php $teamsDB->create($data); ?>
        </li>  
        <li>
            <?php $teamsDB->find($query); ?>
        </li>
        <li>
            <?php $teamsDB->update($query, $data); ?>
        </li>
        <li>
            <?php $teamsDB->delete($query); ?>
        </li>
    </ul>
    <h1> Matches </h1>
    <ul>
        <li>
            <?php $matchesDB->create($data); ?>
        </li>  
        <li>
            <?php $matchesDB->find($query); ?>
        </li>
        <li>
            <?php $matchesDB->update($query, $data); ?>
        </li>
        <li>
            <?php $matchesDB->delete($query); ?>
        </li>
    </ul>
</body>
</html>