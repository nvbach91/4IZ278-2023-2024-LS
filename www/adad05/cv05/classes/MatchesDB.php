<?php

require_once 'Database.php';

class MatchesDB extends Database
{
    public function create($data)
    {
        echo 'Matches DB called method create with parameter "' . $data . '"';
    }
    public function find($query)
    {
        echo 'Matches DB called method find with parameter "' . $query . '"';
    }
    public function update($query, $data)
    {
        echo 'Matches DB called method update with parameters "' . $query . '" and "' . $data . '"';
    }
    public function delete($query)
    {
        echo 'Matches DB called method delete with parameter "' . $query . '"';
    }
}
