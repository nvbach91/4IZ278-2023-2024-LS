<?php 
require './PlayersDB.php';
$playersDB = new PlayersDB();
$playersDB->create([
    'name' => 'David Beckham'
]);
$playersDB->find([
    'name' => 'Ronaldinho'
]);
$playersDB->create([
    'name' => 'David Beckham'
]);

?>

