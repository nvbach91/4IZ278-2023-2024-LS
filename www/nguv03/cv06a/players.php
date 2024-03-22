<?php require_once __DIR__ . '/database.php'; ?>
<?php
$playersDB = new PlayersDB();
// $playersDB->create([
//     'name' => 'David Beckham',
// ]);
// $playersDB->delete([
//     'name' => 'David Beckham',
// ]);
// $players = $playersDB->find([
//     'name' => 'Ronaldo'
// ]);
$players = $playersDB->findAll();
?>
<ul>
    <?php foreach($players as $player): ?>
        <li><?php echo $player['name']; ?></li>
    <?php endforeach; ?>
</ul>
