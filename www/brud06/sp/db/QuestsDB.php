<?php
require_once 'database.php';
class QuestsDB extends Database
{

    function getRandomQuests($limit)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM sp_quests ORDER BY RAND() LIMIT :limit");
        $stmt->bindValue(':limit', (int) $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    function getQuestById($quest_id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM sp_quests WHERE quest_id = :quest_id");
        $stmt->bindValue(':quest_id', (int) $quest_id, PDO::PARAM_INT);
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