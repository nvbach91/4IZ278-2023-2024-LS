<?php

require "database.php";

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
    <h1>MySQL database demo</h1>
    <h2>Players DB</h2>
    <ul>
        <li>
            <h3>Create a player</h3>
            <p><?php echo $playersDB->create('Bob'); ?></p>
        </li>
        <li>
            <h3>Find a player</h3>
            <p><?php echo $playersDB->find('Bob'); ?></p>
        </li>
        <li>
            <h3>Update a player</h3>
            <p><?php echo $playersDB->update('Rob', 'Bob'); ?></p>
        </li>
        <li>
            <h3>Delete a player</h3>
            <p><?php echo $playersDB->delete('Bob'); ?></p>
        </li>
    </ul>
    <h2>Teams DB</h2>
    <ul>
        <li>
            <h3>Create a team</h3>
            <p><?php echo $teamsDB->create('ManUtd'); ?></p>
        </li>
        <li>
            <h3>Find a team</h3>
            <p><?php echo $teamsDB->find('ManUtd'); ?></p>
        </li>
        <li>
            <h3>Update a team</h3>
            <p><?php echo $teamsDB->update('ManCity', 'ManUtd'); ?></p>
        </li>
        <li>
            <h3>Delete a team</h3>
            <p><?php echo $teamsDB->delete('ManUtd'); ?></p>
        </li>
    </ul>
    <h2>Matches DB</h2>
    <ul>
        <li>
            <h3>Create a match</h3>
            <p><?php echo $matchesDB->create('ManUtd vs. ManCity'); ?></p>
        </li>
        <li>
            <h3>Find a match</h3>
            <p><?php echo $matchesDB->find('ManUtd vs. ManCity'); ?></p>
        </li>
        <li>
            <h3>Update a match</h3>
            <p><?php echo $matchesDB->update('Sparta vs. Slavia', 'ManUtd vs. ManCity'); ?></p>
        </li>
        <li>
            <h3>Delete a match</h3>
            <p><?php echo $matchesDB->delete('ManUtd vs. ManCity'); ?></p>
        </li>
    </ul>
</body>

</html>