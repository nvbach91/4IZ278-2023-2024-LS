 
<?php
include_once("./classes/Players.php");
include_once("./classes/Teams.php");
include_once("./classes/Matches.php");

$pDB = new PlayersDB();
$tDB = new TeamsDB();
$mDB = new MatchesDB();
$players = $pDB->read();
$teams = $tDB->read();
$matches =$mDB->read();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>cv05</title>
</head>
<body>
    <h1>Players</h1>
    <?php foreach ($players as $p): ?>
        <p><?= $p['name'] ?></p>
    <?php endforeach; ?>
    <h1>Teams</h1>
    <?php foreach ($teams as $t): ?>
        <p><?= $t['name'] ?></p>
    <?php endforeach; ?>
</body>
</html>