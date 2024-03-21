<?php
class PlayersDB extends Database
{
    public function create($data) {
        echo "PlayersDB create() called.";
        /*
       $statement = $this->$pdo->prepare("INSERT INTO players (name, age, team_id) VALUES (:name, :age, :team_id)");
        $statement->execute([
            ':name' => $data['name'],
            ':age' => $data['age'],
            ':team_id' => $data['team_id']
        ]);
        */
    }
    public function find($query) {
        echo "PlayersDB find() called.";
    }
    public function update($query, $data) {
        echo "PlayersDB update() called.";
    }
    public function delete($query) {
        echo "PlayersDB delete() called.";
    }

}
?>