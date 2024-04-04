<?php
require_once './DatabaseClass.php';

class MatchesDB extends Database {
    public function create($data) {
        // $statement = $this->pdo->prepare('INSERT INTO matches ...');
        // $statement->execute();
 
        echo 'Matches DB called method create';
         
     }
     public function find($query) {
         echo 'Matches DB called method find';
     }
     public function update($query, $data) {
         echo 'Matches DB called method update';
     }
     public function delete($query) {
         echo 'Matches DB called method delete';
     }
     public function findALL($query)
     {
         echo 'Matches DB called method find';
     }
}
// class TeamsDB extends Database {}
// class MatchesDB extends Database {}

// $matchesDB = new MatchesDB();
// $matchesDB->create([]);
// $matchesDB->find([]);
// $matchesDB->update([],[]);
// $matchesDB->delete([]);

// $pdoConnection = DatabaseConnection::getPDOConnection();

?>
