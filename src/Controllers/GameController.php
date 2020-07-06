<?php

namespace eMAGHero\Controllers;

use eMAGHero\Helpers\Logger;
use eMAGHero\Repository\BattleRepository;

class GameController {

    public function startBattle(string $attacker = '', string $defender = '') {

        if (empty($attacker))
            $attacker = 'Orderus';

        if (empty($defender)) {
            $defenderNames = ['Demon Hunter', 'Monk', 'Death Knight'];
            $defender = $defenderNames[array_rand($defenderNames)];
        }

        $BattleRepository = new BattleRepository($attacker, $defender);

        Logger::info("Battle start...");
        Logger::info("");
        
        $BattleRepository->setFirstStriker();

        Logger::info("In the red corner we have {$BattleRepository->getAttackerName()}");
        Logger::info(print_r($BattleRepository->getAttckerStats(), true));
        Logger::info("And in the blue corner we have {$BattleRepository->getDefenderName()}");
        Logger::info(print_r($BattleRepository->getDefenderStats(), true));
        Logger::info("");

        $roundBattle = 1;
        while ($BattleRepository->battleStillRunning($roundBattle)) {

            $attackerName = $BattleRepository->getAttackerName();
            $defenderName = $BattleRepository->getDefenderName();

            if ($roundBattle == 1)
                Logger::info("# First round {$attackerName} attacks!");
            else
                Logger::info("# Round {$roundBattle} - the {$attackerName} attacks!");

            $BattleRepository->calculateAttackerDamage();
            if ($BattleRepository->hasDefenderLuck()) {
                Logger::info("The defender $defenderName was lucky today! Attacker $attackerName missed the shot.");
            } else {
                Logger::info("The attcker $attackerName shot the $defenderName with damage: {$BattleRepository->getDamage()}");
                $specialSkillAttack = $BattleRepository->speckialSkillAttackerLuck();
                if (!empty($specialSkillAttack)) {
                    switch ($specialSkillAttack['key']) {
                        case 'rapid_strike':
                            Logger::info("The $defenderName remaining with healt: " . $BattleRepository->getDefenderHealth());
                            Logger::info("### Special Skill activated ### " . $specialSkillAttack['name']);
                            $BattleRepository->decreaseHealthForDefender();
                            Logger::info("The attcker $attackerName shot aggain the $defenderName with damage: {$BattleRepository->getDamage()}");
                            $BattleRepository->calculateAttackerDamage();
                            break;
                    }
                }
                $specialSkillDefend = $BattleRepository->specialSkillDefenderLuck();
                if (!empty($specialSkillDefend)) {
                    switch ($specialSkillDefend['key']) {
                        case 'magic_shield':
                            Logger::info("### Special Skill activated ### " . $specialSkillDefend['name']);

                            $BattleRepository->halfDamage();
                            Logger::info("The damage was decreased  to: {$BattleRepository->getDamage()}");
                            break;
                    }
                }

                $BattleRepository->decreaseHealthForDefender();
            }
            Logger::info("The $defenderName remaining with healt: " . $BattleRepository->getDefenderHealth());
            Logger::info("");
            $BattleRepository->switchStrikers();
            $roundBattle++;
        }

        Logger::info("And the winner is... " . $BattleRepository->getWinner());
    }

}

?>