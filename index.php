<?php
// Rozhraní DatabaseOperations
interface DatabaseOperations {
    public function create(...$params);
    public function find(...$params);
    public function update(...$params);
    public function delete(...$params);
}

// Abstraktní třída Database
abstract class Database implements DatabaseOperations {
    protected $data;

    public function __construct() {
        $this->data = [];
    }
}

// Podtřída PlayersDB
class PlayersDB extends Database {
    public function create(...$params) {
        $this->data[] = $params;
        echo "Creating a new player record...<br>";
    }

    public function find(...$params) {
        // Simulate finding a player record
        echo "Finding a player record...<br>";
    }

    public function update(...$params) {
        echo "Updating a player record...<br>";
    }

    public function delete(...$params) {
        echo "Deleting a player record...<br>";
    }
}

// Podtřída TeamsDB
class TeamsDB extends Database {
    public function create(...$params) {
        $this->data[] = $params;
        echo "Creating a new team record...<br>";
    }

    public function find(...$params) {
        echo "Finding a team record...<br>";
    }

    public function update(...$params) {
        echo "Updating a team record...<br>";
    }

    public function delete(...$params) {
        echo "Deleting a team record...<br>";
    }
}

// Podtřída MatchesDB
class MatchesDB extends Database {
    public function create(...$params) {
        $this->data[] = $params;
        echo "Creating a new match record...<br>";
    }

    public function find(...$params) {
        echo "Finding a match record...<br>";
    }

    public function update(...$params) {
        echo "Updating a match record...<br>";
    }

    public function delete(...$params) {
        echo "Deleting a match record...<br>";
    }
}

// Testování
$playersDB = new PlayersDB();
$playersDB->create('John Doe', 25);
$playersDB->find('John Doe');
$playersDB->update('John Doe', 26);
$playersDB->delete('John Doe');

$teamsDB = new TeamsDB();
$teamsDB->create('Team A');
$teamsDB->find('Team A');
$teamsDB->update('Team A', 'Team B');
$teamsDB->delete('Team B');

$matchesDB = new MatchesDB();
$matchesDB->create('Match 1');
$matchesDB->find('Match 1');
$matchesDB->update('Match 1', 'Match 2');
$matchesDB->delete('Match 2');