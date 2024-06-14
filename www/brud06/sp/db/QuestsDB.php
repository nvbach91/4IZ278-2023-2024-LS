<?php
require_once 'database.php';
class QuestsDB extends Database
{

    function getRandomQuests($limit)
    {
        $results = $this->runQuery("SELECT * FROM sp_quests ORDER BY RAND() LIMIT :limit", ['limit' => $limit]);
        return $results;
    }

    function getQuestById($quest_id)
    {
        $results = $this->runQuery("SELECT * FROM sp_quests WHERE quest_id = :quest_id", ['quest_id' => $quest_id]);
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
