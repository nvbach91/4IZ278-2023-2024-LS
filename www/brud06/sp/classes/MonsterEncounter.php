<?php
require_once '../classes/Character.php';
require_once '../classes/Monster.php';

class MonsterEncounter
{
    public $report = [];

    public function simulateEncounter(Character $character, Monster $monster)
    {
        $encounterSuccess = false;
        // Get character's and monster's strength
        $characterStrength = $character->getStrength();
        $monsterStrength = $monster->getStrength();

        // Simulate the encounter
        while ($character->getHitpoints() > 0 && $monster->getHitpoints() > 0) {
            // Character hits monster
            $this->report[] = $character->getName() . " hits " . $monster->getName() . " for " . $characterStrength . " HP.";
            $monster->setHitpoints($monster->getHitpoints() - $characterStrength);
            if ($monster->getHitpoints() <= 0) {
                $this->report[] = $monster->getName() . " has died.";
                break;
            } else {
                $this->report[] = $monster->getName() . " has " . $monster->getHitpoints() . " HP left.";
            }

            // Monster hits character
            $character->setHitpoints($character->getHitpoints() - $monsterStrength);
            $this->report[] = $monster->getName() . " hits " . $character->getName() . " for " . $monsterStrength . " HP.";
            if ($character->getHitpoints() <= 0) {
                $this->report[] = $character->getName() . " has died.";
            } else {
                $this->report[] = $character->getName() . " has " . $character->getHitpoints() . " HP left.";
            }
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

    public function getReport()
    {
        return $this->report;
    }
}
?>