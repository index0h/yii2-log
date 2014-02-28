<?php
/**
 * @link      https://github.com/index0h/yii2-log
 * @copyright Copyright (c) 2014 Roman Levishchenko <index.0h@gmail.com>
 * @license   https://raw.github.com/index0h/yii2-log/master/LICENSE
 */

/**
 * Check LogstashTarget.
 *
 * @author Roman Levishchenko <index.0h@gmail.com>
 */
class LogstashCest
{

    public function addWrongLogstashLog(\CodeGuy $I, \Codeception\Scenario $scenario)
    {
        if ($scenario->running() === false) {
            return;
        }
        $I->removeEmergencyLog();
        $I->addWrongLogstashLog('WrongLogstashLog');
        $I->seeEmergencyLog('WrongLogstashLog');
    }
}