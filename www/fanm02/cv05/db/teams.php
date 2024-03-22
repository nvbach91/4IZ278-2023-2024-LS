<?php

require_once 'utils/db.php';

class TeamsDB extends Database
{
  public function create($query)
  {
    echo "TeamsDB create";
  }
  public function find($query)
  {
    echo "TeamsDB read";
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

?>