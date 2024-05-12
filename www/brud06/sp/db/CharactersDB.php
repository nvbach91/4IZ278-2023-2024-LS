<?php
require_once 'database.php';
class CharactersDB extends Database
{

function createCharacter($character)
{
    $sql = "INSERT INTO sp_characters (name, image, class, gold, xp, level, strength, dexterity, hitpoints, luck, stamina, user_id) VALUES (:name, :image, :class, :gold, :xp, :level, :strength, :dexterity, :hitpoints, :luck, :stamina, :user_id)";
    
    $result = $this->runQuery($sql, [
        'name' => $character->getName(),
        'image' => $character->getImage(),
        'class' => $character->getClass(),
        'gold' => $character->getGold(),
        'xp' => $character->getXp(),
        'level' => $character->getLevel(),
        'strength' => $character->getStrength(),
        'dexterity' => $character->getDexterity(),
        'hitpoints' => $character->getHitpoints(),
        'luck' => $character->getLuck(),
        'stamina' => $character->getStamina(),
        'user_id' => $character->getUserId(),
    ]);

    return $result !== false;
}
function findCharacterByUserId($userId)
{
    $sql = "SELECT * FROM sp_characters WHERE user_id = :user_id";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute(['user_id' => $userId]);
    return $stmt->fetch();
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