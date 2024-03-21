<?php
class Teams
{
    public function __construct(
        public int $id,
        public string $name,
        public array $players
        ) { }
}

class TeamsDB extends Database {
    public function create($team) 
    {
    $statement = $this->DB->prepare('INSERT INTO cv05_teams (name) VALUES (:name)');
    $statement->bindParam(':name', $team->name, PDO::PARAM_STR);
    $statement->execute();
    $res = $statement->fetchAll(PDO::FETCH_ASSOC);
    }
    public function read() 
    {
        $statement = $this->DB->prepare('SELECT * FROM cv05_teams');
        $statement->execute();
        $res = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $res;
    }

    public function update($team) 
    {
        $statement = $this->DB->prepare('UPDATE cv05_teams SET name = :name WHERE id = :id');
        $statement->bindParam(':name', $team->name, PDO::PARAM_STR);
        $statement->execute();
    }

    public function delete($team) 
    {
        $statement = $this->DB->prepare('DELETE FROM cv05_teams WHERE id = :id');
        $statement->bindParam(':id', $team->id, PDO::PARAM_INT);
        $statement->execute();

    }
}