<?php
require_once 'database.php';

class DungeonsDB extends Database
{
    function getDungeonById($id)
    {
        $results = $this->runQuery("SELECT * FROM sp_dungeons WHERE dungeon_id = :id", ['id' => $id]);
        return $results ? $results[0] : false;
    }
    function create($attribute)
    {
        //empty
    }
    function update($attribute, $data)
    {
        //empty
    }
    function delete($attribute)
    {
        //empty
    }
    function find($attribute)
    {
        //empty
    }
}
