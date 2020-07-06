<?php

namespace eMAGHero\Player;

class WildBeast extends PlayerAbstract {

    public function __construct(string $name) {
        $this->name = $name;

        $this->health = random_int(60, 90);

        $this->strength = random_int(60, 90);

        $this->defence = random_int(40, 60);

        $this->speed = random_int(40, 60);

        $this->luck = random_int(25, 40);
    }

}
