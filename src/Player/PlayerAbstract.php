<?php

namespace eMAGHero\Player;

use eMAGHero\Interfaces\PlayerInterface;

class PlayerAbstract implements PlayerInterface {

    /**
     * The name of the player.
     * @var string
     */
    protected $name;

    /**
     * The health of the player.
     * @var int 
     */
    protected $health;

    /**
     * The strength player.
     * @var type 
     */
    protected $strength;

    /**
     * The defence of the player.
     * @var int 
     */
    protected $defence;

    /**
     * The speed of the player.
     * @var int 
     */
    protected $speed;

    /**
     * The luck of the player.
     * @var int
     */
    protected $luck;

    /**
     *
     * @var type 
     */
    protected $specialSkills = [];

    /**
     * 
     * @return type
     */
    public function getName() {
        return $this->name;
    }

    public function setHealth($health) {
        $this->health = $health;
        return $this;
    }

    public function getHealth() {
        return $this->health;
    }

    public function setStrength($strength) {
        $this->strength = $strength;
        return $this;
    }

    public function getStrength() {
        return $this->strength;
    }

    public function setDefence($defence) {
        $this->defence = $defence;
        return $this;
    }

    public function getDefence() {
        return $this->defence;
    }

    public function setSpeed($speed) {
        $this->speed = $speed;
        return $this;
    }

    public function getSpeed() {
        return $this->speed;
    }

    public function setLuck($luck) {
        $this->luck = $luck;
        return $this;
    }

    public function getLuck() {
        return $this->luck;
    }

    public function hasLuck() {
        $randomLuck = rand(0, 100);
        return $this->getLuck() > $randomLuck;
    }

    public function hasSpecialSkills() {
        return !empty($this->specialSkills);
    }

    public function getSpecialSkills() {
        return $this->specialSkills;
    }

    public function decreaseHealth($damage) {
        $this->health = $this->health - $damage;
    }

}
