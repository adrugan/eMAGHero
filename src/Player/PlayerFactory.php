<?php

namespace eMAGHero\Player;

use eMAGHero\Interfaces\PlayerInterface;

class PlayerFactory {

    private $player;

    public function create(string $player) {
        if (empty($player))
            throw new \Exception("An player name must be defined!");

        $class = "eMAGHero\\Player\\" . str_replace(" ", "", ucwords($player));
        // when don't have any player defined, use the WildBeatsAdapter as default!
        if (!class_exists($class)) {
            $class = "eMAGHero\\Player\\Wildbeast";
            $this->player = new $class($player);
        } else {
            $this->player = new $class();
        }

        if (!($this->player instanceof PlayerInterface))
            throw new \ErrorException($class . ' needs to implement PlayerInterface!');

        return $this->player;
    }

}
