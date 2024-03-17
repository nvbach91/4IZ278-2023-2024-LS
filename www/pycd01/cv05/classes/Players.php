<?php
include_once("./classes/Users.php");
include_once("./utils/db.php");

class Players extends Users
{
    public function __construct(
        public int $skillRating,
        public Teams $team
        ) { }
}

class PlayersDB extends Database {
    public function create($player) 
    {
    $statement = $this->DB->prepare('INSERT INTO cv05_players (name, email, age, skillRating, teamId) VALUES (:name, :email, :age, :skillRating, :teamId)');
    $statement->bindParam(':name', $player->name, PDO::PARAM_STR);
    $statement->bindParam(':email', $player->email, PDO::PARAM_STR);
    $statement->bindParam(':age', $player->age, PDO::PARAM_INT);
    $statement->bindParam(':skillRating', $player->skillRating, PDO::PARAM_INT);
    $statement->bindParam(':teamId', $player->team->id, PDO::PARAM_INT);
    $statement->execute();
    $res = $statement->fetchAll(PDO::FETCH_ASSOC);

    var_dump($res);
    }
    public function read() 
    {
        $statement = $this->DB->prepare('SELECT * FROM cv05_players');
        $statement->execute();
        $res = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $res;
    }

    public function update($player) 
    {
        $statement = $this->DB->prepare('UPDATE cv05_players SET name = :name, email = :email, age = :age, skillRating = :skillRating, teamId = :teamId WHERE id = :id');
        $statement->bindParam(':name', $player->name, PDO::PARAM_STR);
        $statement->bindParam(':email', $player->email, PDO::PARAM_STR);
        $statement->bindParam(':age', $player->age, PDO::PARAM_INT);
        $statement->bindParam(':skillRating', $player->skillRating, PDO::PARAM_INT);
        $statement->bindParam(':teamId', $player->team->id, PDO::PARAM_INT);
        $statement->execute();
    }

    public function delete($player) 
    {
        $statement = $this->DB->prepare('DELETE FROM cv05_players WHERE id = :id');
        $statement->bindParam(':id', $player->id, PDO::PARAM_INT);
        $statement->execute();

    }
}
