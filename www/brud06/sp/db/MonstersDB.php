<?php
require_once 'database.php';

class MonstersDB extends Database
{
    function getMonsterById($id)
    {
        $results = $this->runQuery("SELECT * FROM sp_monsters WHERE monster_id = :id", ['id' => $id]);
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
