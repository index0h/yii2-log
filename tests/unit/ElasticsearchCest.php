<?php
/**
 * @link      https://github.com/index0h/yii2-log
 * @copyright Copyright (c) 2014 Roman Levishchenko <index.0h@gmail.com>
 * @license   https://raw.github.com/index0h/yii2-log/master/LICENSE
 */

/**
 * Check ElasticsearchTarget.
 *
 * @author Roman Levishchenko <index.0h@gmail.com>
 */
class ElasticsearchCest
{
    public function addCorrectElasticsearchLog(\CodeGuy $I, \Codeception\Scenario $scenario)
    {
        if ($scenario->running() === false) {
            return;
        }
        $I->removeEmergencyLog();
        $I->flushElasticsearch();

        $I->addElasticsearchLog('CorrectLog');
        $I->dontSeeEmergencyLog();
        $I->seeElasticsearchLog('CorrectLog');
    }

    public function addWrongElasticsearchLog(\CodeGuy $I, \Codeception\Scenario $scenario)
    {
        if ($scenario->running() === false) {
            return;
        }
        $I->removeEmergencyLog();
        $I->flushElasticsearch();
        $I->addWrongElasticsearchLog('WrongElasticsearchLog');
        $I->seeEmergencyLog('WrongElasticsearchLog');
    }
}
