<?php

require_once 'db.php';

class PlayersDB extends Database
{
  public function create($data)
  {
    echo "PlayersDB create";
  }
  public function find($query)
  {
    echo "PlayersDB find";
  }
  public function update($query, $data)
  {
    echo "PlayersDB update";
  }
  public function delete($query)
  {
    echo "PlayersDB delete";
  }
}
class TeamsDB extends Database
{
  public function create($data)
  {
    echo "TeamsDB create";
  }
  public function find($query)
  {
    echo "TeamsDB find";
  }
  public function update($query, $data)
  {
    echo "TeamsDB update";
  }
  public function delete($query)
  {
    echo "TeamsDB delete";
  }
}
class MatchesDB extends Database
{
  public function create($data)
  {
    echo "MatchesDB create";
  }
  public function find($query)
  {
    echo "MatchesDB find";
  }
  public function update($query, $data)
  {
    echo "MatchesDB update";
  }
  public function delete($query)
  {
    echo "MatchesDB delete";
  }
}

//$pdoConnection = DatabaseConnection::getPDOConnection();
