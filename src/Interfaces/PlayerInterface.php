<?php

namespace eMAGHero\Interfaces;

interface PlayerInterface {

    public function getName();
    
    public function setHealth($health);

    public function getHealth();

    public function setStrength($strength);

    public function getStrength();

    public function setDefence($defence);

    public function getDefence();

    public function setSpeed($speed);

    public function getSpeed();

    public function setLuck($luck);

    public function getLuck();

    public function decreaseHealth($damage);

    public function hasLuck();

    public function hasSpecialSkills();
}
