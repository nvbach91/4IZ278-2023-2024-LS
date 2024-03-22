<?php

require_once 'Database.php';

class TeamsDB extends Database
{
    public function create($data)
    {
        echo 'Teams DB called method create with parameter "' . $data . '"';
    }
    public function find($query)
    {
        echo 'Teams DB called method find with parameter "' . $query . '"';
    }
    public function update($query, $data)
    {
        echo 'Teams DB called method update with parameters "' . $query . '" and "' . $data . '"';
    }
    public function delete($query)
    {
        echo 'Teams DB called method delete with parameter "' . $query . '"';
    }
}
