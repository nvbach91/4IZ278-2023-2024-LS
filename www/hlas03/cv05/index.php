<?php

require 'database.php';

$playersDB = new PlayersDB();
$teamsDB = new TeamsDB();
$matchesDB = new MatchesDB();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>database connections</h1>
    <ul>
        <li>Host: <?php echo DB_HOSTNAME; ?></li>
        <li>dbname: <?php echo DB_DATABASE;  ?></li>
        <li>username: <?php echo DB_USERNAME;  ?></li>
    </ul>


    <h1>MySqL database operations</h1>

    <ul>
        <li>
            <strong>PlayersDB:</strong>
            <ul>
                <li>Create: <?php $playersDB->create('name'); ?></li>
                <li>Find: <?php $playersDB->find('name'); ?></li>
                <li>Update: <?php $playersDB->update('name', 'name2'); ?></li>
                <li>Delete: <?php $playersDB->delete('name'); ?></li>
            </ul>
        </li>
        <li>
            <strong>TeamsDB:</strong>
            <ul>
            <li>Create: <?php $teamsDB->create('name'); ?></li>
                <li>Find: <?php $teamsDB->find('name'); ?></li>
                <li>Update: <?php $teamsDB->update('name', 'name2'); ?></li>
                <li>Delete: <?php $teamsDB->delete('name'); ?></li>
            </ul>
        </li>
        <li>
            <strong>MatchesDB:</strong>
            <ul>
            <li>Create: <?php $matchesDB->create('name'); ?></li>
                <li>Find: <?php $matchesDB->find('name'); ?></li>
                <li>Update: <?php $matchesDB->update('name', 'name2'); ?></li>
                <li>Delete: <?php $matchesDB->delete('name'); ?></li>
            </ul>
        </li>
    </ul>
</body>
</html>