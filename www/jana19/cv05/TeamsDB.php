<?php
require __DIR__ . '/database.php';

class TeamsDB extends Database {
    public function create($data) {
       // $statement = $this->pdo->prepare('INSERT INTO teams ...');
       // $statement->execute();

       echo 'Teams DB called method create';
        
    }
    public function find($query) {
        echo 'Teams DB called method find';
    }
    public function update($query, $data) {
        echo 'Teams DB called method update';
    }
    public function delete($query) {
        echo 'Teams DB called method delete';
    }
}
// class TeamsDB extends Database {}
// class MatchesDB extends Database {}

$teamsDB = new TeamsDB();
$teamsDB->create([]);
$teamsDB->find([]);
$teamsDB->update([],[]);
$teamsDB->delete([]);

// $pdoConnection = DatabaseConnection::getPDOConnection();

?>