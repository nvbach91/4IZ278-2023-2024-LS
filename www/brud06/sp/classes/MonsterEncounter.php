<?php
require_once '../classes/Character.php';
require_once '../classes/Monster.php';

class MonsterEncounter
{
    public function simulateEncounter(Character $character, Monster $monster)
    {
        $encounterSuccess = false;
        // Get character's and monster's strength
        $characterStrength = $character->getStrength();
        $monsterStrength = $monster->getStrength();

        // Simulate the encounter
        while ($character->getHitpoints() > 0 && $monster->getHitpoints() > 0) {
            // Character hits monster
            $monster->setHitpoints($monster->getHitpoints() - $characterStrength);
            if ($monster->getHitpoints() <= 0) {
                break;
            }

            // Monster hits character
            $character->setHitpoints($character->getHitpoints() - $monsterStrength);
        }

        // Determine the outcome of the encounter
        if ($character->getHitpoints() > 0) {
            $encounterSuccess = true;
        } else {
            $encounterSuccess = false;
        }
        return $encounterSuccess;
    }
    public function encounterResultDisplay($encounterResult)
    {
        if ($encounterResult) {
            echo "You have defeated the monster!";
        } else {
            echo "You have been defeated by the monster!";
        }
    }
}
