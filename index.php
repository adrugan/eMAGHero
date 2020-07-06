<?php 

use eMAGHero\Controllers\GameController;

require_once realpath("vendor/autoload.php");

$game = new GameController();
$game->startBattle();