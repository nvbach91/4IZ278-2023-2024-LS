<?php
require_once 'database.php';

class DungeonsDB extends Database
{
    function getDungeonById($id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM sp_dungeons WHERE dungeon_id = :id");
        $stmt->bindValue(':id', (int) $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
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