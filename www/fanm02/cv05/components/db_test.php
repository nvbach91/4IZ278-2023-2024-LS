<?php 

require 'db/players.php';
require 'db/teams.php';
require 'db/matches.php';

$players = new PlayersDB();
$teams = new TeamsDB();
$matches = new MatchesDB();

?>

<h2>PlayersDB</h2>
<div><?php $players->create('') ?></div>
<div><?php $players->find('') ?></div>
<div><?php $players->update('', []) ?></div>
<div><?php $players->delete('') ?></div>

<br>

<h2>PlayersDB</h2>
<div><?php $teams->create('') ?></div>
<div><?php $teams->find('') ?></div>
<div><?php $teams->update('', []) ?></div>
<div><?php $teams->delete('') ?></div>

<br>

<h2>PlayersDB</h2>
<div><?php $matches->create('') ?></div>
<div><?php $matches->find('') ?></div>
<div><?php $matches->update('', []) ?></div>
<div><?php $matches->delete('') ?></div>