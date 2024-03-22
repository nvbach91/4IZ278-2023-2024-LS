<?php

require_once 'utils/db.php';

class PlayersDB extends Database
{
  public function create($query)
  {
    echo "PlayersDB create";
  }
  public function find($query)
  {
    echo "PlayersDB read";
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

?>