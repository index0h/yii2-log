<?php
/**
 * @link      https://github.com/index0h/yii2-log
 * @copyright Copyright (c) 2014 Roman Levishchenko <index.0h@gmail.com>
 * @license   https://raw.github.com/index0h/yii2-log/master/LICENSE
 */

/**
 * Check RedisTarget.
 *
 * @author Roman Levishchenko <index.0h@gmail.com>
 */
class RedisCest
{
    public function addCorrectRedisLog(\CodeGuy $I, \Codeception\Scenario $scenario)
    {
        if ($scenario->running() === false) {
            return;
        }
        $I->removeEmergencyLog();
        $I->flushRedis();
        $I->addRedisLog('CorrectLog');
        $I->dontSeeEmergencyLog();
        $I->seeRedisLog('CorrectLog');
    }

    public function addWrongRedisLog(\CodeGuy $I, \Codeception\Scenario $scenario)
    {
        if ($scenario->running() === false) {
            return;
        }
        $I->removeEmergencyLog();
        $I->flushRedis();
        $I->addWrongRedisLog('WrongRedisLog');
        $I->seeEmergencyLog('WrongRedisLog');
    }
}
