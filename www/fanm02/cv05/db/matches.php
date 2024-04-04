<?php

require_once 'utils/db.php';

class MatchesDB extends Database
{
  public function create($query)
  {
    echo "MatchesDB create";
  }
  public function find($query)
  {
    echo "MatchesDB read";
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

?>