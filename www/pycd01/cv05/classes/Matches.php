<?php
class Matches
{
    public function __construct(
        public int $id,
        public int $homeTeamId,
        public int $awayTeamId,
        public int $homeScore,
        public int $awayScore
        ) { }
} 

class MatchesDB extends Database {
    public function create($match) 
    {
    $statement = $this->DB->prepare('INSERT INTO cv05_matches (homeTeamId, awayTeamId, homeScore, awayScore) VALUES (:homeTeamId, :awayTeamId, :homeScore, :awayScore)');
    $statement->bindParam(':homeTeamId', $match->homeTeamId, PDO::PARAM_INT);
    $statement->bindParam(':awayTeamId', $match->awayTeamId, PDO::PARAM_INT);
    $statement->bindParam(':homeScore', $match->homeScore, PDO::PARAM_INT);
    $statement->bindParam(':awayScore', $match->awayScore, PDO::PARAM_INT);
    $statement->execute();
    $res = $statement->fetchAll(PDO::FETCH_ASSOC);
    }
    public function read() 
    {
        $statement = $this->DB->prepare('SELECT * FROM cv05_matches');
        $statement->execute();
        $res = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $res;
    }

    public function update($match) 
    {
        $statement = $this->DB->prepare('UPDATE cv05_matches SET homeTeamId = :homeTeamId, awayTeamId = :awayTeamId, homeScore = :homeScore, awayScore = :awayScore  WHERE id = :id');
        $statement->bindParam(':homeTeamId', $match->homeTeamId, PDO::PARAM_INT);
        $statement->bindParam(':awayTeamId', $match->awayTeamId, PDO::PARAM_INT);
        $statement->bindParam(':homeScore', $match->homeScore, PDO::PARAM_INT);
        $statement->bindParam(':awayScore', $match->awayScore, PDO::PARAM_INT);
        $statement->execute();
    }

    public function delete($match) 
    {
        $statement = $this->DB->prepare('DELETE FROM cv05_matches WHERE id = :id');
        $statement->bindParam(':id', $match->id, PDO::PARAM_INT);
        $statement->execute();

    }
}