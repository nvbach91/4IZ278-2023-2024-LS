<?php
require_once 'database.php';
$db_array = [
  'players' => new PlayersDB(),
  'teams' => new TeamsDB(),
  'matches' => new MatchesDB()
];
?>

<?php include "./includes/head.php" ?>
<h2>Database connection</h2>
<ul>
    <li><?php DatabaseConnection::printConfig(); ?>></li>
</ul>
<?php foreach ($db_array as $db) : ?>
  <h2><?= get_class($db) ?></h2>
  <ul>
    <li><?php $db->create([]); ?></li>
    <li><?php $db->find([]); ?></li>
    <li><?php $db->update([], []); ?></li>
    <li><?php $db->delete([]); ?></li>
  </ul>
<?php endforeach; ?>
<?php include "./includes/foot.php" ?>