<?php
/**
 * @link      https://github.com/index0h/yii2-log
 * @copyright Copyright (c) 2014 Roman Levishchenko <index.0h@gmail.com>
 * @license   https://raw.github.com/index0h/yii2-log/master/LICENSE
 */

/**
 * Check LogstashFileTarget.
 *
 * @author Roman Levishchenko <index.0h@gmail.com>
 */
class LogstashFileCest
{
    public function addLogstashLogToFile(\CodeGuy $I, \Codeception\Scenario $scenario)
    {
        if ($scenario->running() === false) {
            return;
        }
        $I->removeLogstashFile();
        $I->addLogstashFileLog('logstashFileLog_array', 'array');
        $I->addLogstashFileLog('logstashFileLog_stdClass', 'stdClass');
        $I->seeLogstashFile();
    }
}