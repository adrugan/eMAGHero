<?php

namespace eMAGHero\Repository;

use eMAGHero\Player\PlayerFactory;

class BattleRepository {

    const MAX_BATTLE_ROUNDS = 20;

    private $attacker;
    private $defender;
    private $damage;

    public function __construct(string $attacker, string $defender) {
        $this->attacker = (new PlayerFactory())->create($attacker);
        $this->defender = (new PlayerFactory())->create($defender);
    }

    /**
     * Return the defender name.
     * 
     * @return string
     */
    public function getAttackerName() {
        return $this->attacker->getName();
    }

    public function getAttckerStats() {
        return [
            'name' => $this->attacker->getName(),
            'health' => $this->attacker->getHealth(),
            'strength' => $this->attacker->getStrength(),
            'defence' => $this->attacker->getDefence(),
            'speed' => $this->attacker->getSpeed(),
            'luck' => $this->attacker->getLuck()
        ];
    }

    /**
     * Return the defender name.
     * 
     * @return string
     */
    public function getDefenderName() {
        return $this->defender->getName();
    }

    public function getDefenderStats() {
        return [
            'name' => $this->defender->getName(),
            'health' => $this->defender->getHealth(),
            'strength' => $this->defender->getStrength(),
            'defence' => $this->defender->getDefence(),
            'speed' => $this->defender->getSpeed(),
            'luck' => $this->defender->getLuck()
        ];
    }

    /**
     * Decide who is the first striker;
     */
    public function setFirstStriker() {
        if ($this->defenderHasGraterSpeed()) {
            $this->switchStrikers();
        }

        if ($this->checkIfPlayersHasEqualSpeed() && $this->defenderHasGreaterLuck()) {
            $this->switchStrikers();
        }
    }

    /**
     * Switch the players position.
     */
    public function switchStrikers() {
        $oneAttacker = $this->attacker;
        $oneDefender = $this->defender;

        $this->attacker = $oneDefender;
        $this->defender = $oneAttacker;
    }

    /**
     * Check if the battle is still active
     * 
     * @param type $roundBattle
     * @return bool
     */
    public function battleStillRunning($roundBattle) {
        return $this->playersStillHaveHealth() && $roundBattle <= self::MAX_BATTLE_ROUNDS;
    }

    /**
     * Return the damage.
     * 
     * @return int
     */
    public function getDamage() {
        return $this->damage;
    }

    /**
     * Calculate the damage for the attacker.
     */
    public function calculateAttackerDamage() {
        $this->damage = $this->attacker->getStrength() - $this->defender->getDefence();
    }

    /**
     * Decrease the health for the defender after get a shot.
     */
    public function decreaseHealthForDefender() {
        $this->defender->decreaseHealth($this->damage);
    }

    /**
     * Decrease the damage to half.
     */
    public function halfDamage() {
        $this->damage = $this->damage / 2;
    }

    /**
     * Get health of the defender.
     * 
     * @return type
     */
    public function getDefenderHealth() {
        return $this->defender->getHealth();
    }

    /**
     * Check if the players still have health.
     * 
     * @return bool - true if both players still have health.
     */
    public function playersStillHaveHealth() {
        return $this->attacker->getHealth() > 0 && $this->defender->getHealth() > 0;
    }

    /**
     * Check if the defender has grater speed than attacker.
     * 
     * @return bool - true when defender has greater speed, otherwise false.
     */
    public function defenderHasGraterSpeed() {
        return $this->defender->getSpeed() > $this->attacker->getSpeed();
    }

    /**
     * Check if both players have equal speed.
     * 
     * @return bool - when bout players have equal speed, otherwise false.
     */
    public function checkIfPlayersHasEqualSpeed() {
        return $this->defender->getSpeed() == $this->attacker->getSpeed();
    }

    /**
     * Check if the defender has greater luck then attacker.
     * 
     * @return bool - true when defender has greater luck, otherwise false.
     */
    public function defenderHasGreaterLuck() {
        return $this->defender->getLuck() > $this->attacker->getLuck();
    }

    /**
     * Check if the defender has luck.
     * 
     * @return type
     */
    public function hasDefenderLuck() {
        return $this->defender->hasLuck();
    }

    /**
     * Get defender special skill.
     * 
     * @return array
     */
    public function specialSkillDefenderLuck() {

        if ($this->defender->hasSpecialSkills()) {
            $specialSkills = $this->defender->getSpecialSkills();
            foreach ($specialSkills['defender'] as $skill) {
                if ($skill['chance'] > random_int(0, 100)) {
                    return $skill;
                }
            }
        }
        return [];
    }

    /**
     * Get attacker special skill.
     * 
     * @return array
     */
    public function speckialSkillAttackerLuck() {
        if ($this->attacker->hasSpecialSkills()) {
            $specialSkills = $this->attacker->getSpecialSkills();
            foreach ($specialSkills['attack'] as $skill) {
                if ($skill['chance'] > random_int(0, 100)) {
                    return $skill;
                }
            }
        }
        return [];
    }

    /**
     * Return the winner name.
     * 
     * @return string
     */
    public function getWinner() {
        if ($this->attacker->getHealth() > $this->defender->getHealth()) {
            return $this->attacker->getName();
        } else {
            return $this->defender->getName();
        }

        if ($this->attacker->getHealth() > 0)
            return $this->attacker->getName();

        if ($this->defender->getHealth() > 0)
            return $this->defender->getName();
    }

}
