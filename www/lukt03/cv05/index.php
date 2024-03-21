<?php
require './database.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MySQL database demo</title>
</head>
<body>
    <h1>MySQL database demo</h1>
    <?php

    $playersDB = new PlayersDB();
    $playersDB->create([ 'name' => 'Tomas Jedno', 'age' => 18 ]);
    $playersDB->create([ 'name' => 'Konrad Spinks', 'age' => 42 ]);
    $players = $playersDB->find([ 'id' => 1 ]);
    $playersDB->update([ 'id' => 1 ], [ 'age' => 28 ]);

    $matchesDB = new MatchesDB();
    $matchesDB->create([ 'venue' => 'VSE Zizkov', 'home' => 0, 'guest' => 0 ]);

    $teamsDB = new TeamsDB();
    $teamsDB->create([ 'name' => 'FC Praha' ]);
    $teamsDB->delete([ 'id' => 0 ]);

    ?>
</body>
</html>
