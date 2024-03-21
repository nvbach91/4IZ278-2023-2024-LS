<?php

require_once 'Database.php';

class PlayersDB extends Database
{
    public function create($data)
    {
        echo 'Players DB called method create with parameter "' . $data . '"';
    }
    public function find($query)
    {
        echo 'Players DB called method find with parameter "' . $query . '"';
    }
    public function update($query, $data)
    {
        echo 'Players DB called method update with parameters "' . $query . '" and "' . $data . '"';
    }
    public function delete($query)
    {
        echo 'Players DB called method delete with parameter "' . $query . '"';
    }
}
