<?php
require_once 'database.php';
$db_array = [
    'players' => new PlayersDB(),
    'teams' => new TeamsDB(),
    'matches' => new MatchesDB()
];
?>

<?php include "./includes/header.php" ?>
<?php foreach ($db_array as $db) : ?>
    <h2><?= get_class($db) ?></h2>
    <ul>
        <li>You called <?php $db->create([]); ?> method</li>
        <li>You called <?php $db->find([]); ?> method</li>
        <li>You called <?php $db->update([], []); ?> method</li>
        <li>You called <?php $db->delete([]); ?> method</li>
    </ul>
<?php endforeach; ?>
<?php include "./includes/footer.php" ?>