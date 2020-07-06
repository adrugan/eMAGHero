<?php

namespace eMAGHero\Player;

use eMAGHero\Interfaces\PlayerInterface;
use eMAGHero\Traits\Skill\MagicShield;
use eMAGHero\Traits\Skill\RapidStrike;

class Orderus extends PlayerAbstract {

    use MagicShield,
        RapidStrike;

    protected $name = 'Orderus';

    public function __construct() {
        $this->health = random_int(70, 100);

        $this->strength = random_int(70, 80);

        $this->defence = random_int(45, 55);

        $this->speed = random_int(40, 50);

        $this->luck = random_int(10, 30);

        if (isset($this->magicShield))
            $this->specialSkills['defender'][] = $this->magicShield;

        if (isset($this->rapidStrike)) {
            $this->specialSkills['attack'][] = $this->rapidStrike;
        }
    }

}
