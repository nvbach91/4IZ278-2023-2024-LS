<?php 

require '.' . DIRECTORY_SEPARATOR . 'database.php';

$playerDB = new PlayersDB();
$teamsDB = new TeamsDB();
$matchesDB = new MatchesDB();

$classes = [
    'Players' => $playerDB,
    'Teams' => $teamsDB,
    'Matches' => $matchesDB,
];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>SQL database demo</h1>
    <ul>
        <?php foreach($classes as $className => $name): ?>
            <li>
                <h2><?php echo $className; ?></h2>
                <div><?php echo $name->create([]); ?></div>
                <div><?php echo $name->find([]); ?></div>
                <div><?php echo $name->update([], []); ?></div>
                <div><?php echo $name->delete([]); ?></div>
            </li>
        <?php endforeach; ?>
    </ul>
</body>
</html>;