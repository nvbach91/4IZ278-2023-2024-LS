<?php
require_once 'database.php';
class CharactersDB extends Database
{

    function createCharacter($character)
    {
        $sql = "INSERT INTO sp_characters (name, image, class, gold, xp, level, strength, hitpoints, luck, stamina, last_action_time, progression, user_id) VALUES (:name, :image, :class, :gold, :xp, :level, :strength, :hitpoints, :luck, :stamina, :last_action_time, :progression, :user_id)";

        $result = $this->runQuery($sql, [
            'name' => $character->getName(),
            'image' => $character->getImage(),
            'class' => $character->getClass(),
            'gold' => $character->getGold(),
            'xp' => $character->getXp(),
            'level' => $character->getLevel(),
            'strength' => $character->getStrength(),
            'hitpoints' => $character->getHitpoints(),
            'luck' => $character->getLuck(),
            'stamina' => $character->getStamina(),
            'last_action_time' => $character->getLastActionTime(),
            'progression'=>$character->getProgression(),
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
    function findCharacterById($id)
    {
        $sql = "SELECT * FROM sp_characters WHERE character_id = :character_id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['character_id' => $id]);
        return $stmt->fetch();
    }

    function updateCharacter($character)
    {
        $sql = "UPDATE sp_characters SET name = :name, image = :image, class = :class, gold = :gold, xp = :xp, level = :level, strength = :strength, hitpoints = :hitpoints, luck = :luck, stamina = :stamina, last_action_time = :last_action_time, progression = :progression WHERE user_id = :user_id";
        
        $result = $this->runQuery($sql, [
            'name' => $character->getName(),
            'image' => $character->getImage(),
            'class' => $character->getClass(),
            'gold' => $character->getGold(),
            'xp' => $character->getXp(),
            'level' => $character->getLevel(),
            'strength' => $character->getStrength(),
            'hitpoints' => $character->getHitpoints(),
            'luck' => $character->getLuck(),
            'stamina' => $character->getStamina(),
            'last_action_time' => $character->getLastActionTime(),
            'progression'=>$character->getProgression(),
            'user_id' => $character->getUserId(),
        ]);

        return $result !== false;
    }
    function deleteCharacter($characterId)
    {
        $sql = "DELETE FROM sp_characters WHERE character_id = :character_id";
        $stmt = $this->pdo->prepare($sql);
        $result = $stmt->execute(['character_id' => $characterId]);
        return $result !== false;
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
