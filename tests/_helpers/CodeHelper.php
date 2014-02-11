<?php
/**
 * @link      https://github.com/index0h/yii-log
 * @copyright Copyright (c) 2014 Roman Levishchenko <index.0h@gmail.com>
 * @license   https://raw.github.com/index0h/yii-log/master/LICENSE
 */

namespace Codeception\Module;

use ElasticSearch\Client as ESClient;
use Predis\Client as PredisClient;

/**
 * @author Roman Levishchenko <index.0h@gmail.com>
 */
class CodeHelper extends \Codeception\Module
{
    /** Alias to emergency log file. */
    const EMERGENCY_LOG = '@tests/_log/emergency.log';

    /** Alias to logstash log file. */
    const LOGSTASH_FILE_LOG = '@tests/_log/logstash.log';

    /** Redis log key. */
    const REDIS_LOG = 'yii_log';

    /**
     * @param string $message Message to log.
     */
    public function addElasticsearchLog($message)
    {
        $this->addLog($message, 'ElasticsearchTarget');
        sleep(1);
    }

    /**
     * @param string $message Message to log.
     * @param string $type    Type of message passed to logger.
     */
    public function addLogstashFileLog($message, $type)
    {
        switch ($type) {
            case 'array':
                $message = ['@message' => $message];
                break;
            case 'stdClass':
                $tmp = new \stdClass();
                $tmp->{'@message'} = $message;
                $message = $tmp;
                break;
        }
        \Yii::error($message, 'LogstashFileTarget');
        \Yii::$app->getLog()->flush(true);
    }

    /**
     * @param string $message Message to log.
     */
    public function addRedisLog($message)
    {
        $this->addLog($message, 'RedisTarget');
    }

    /**
     * @param string $message Message to log.
     */
    public function addWrongElasticsearchLog($message)
    {
        $this->addLog($message, 'WrongElasticsearchTarget');
    }

    /**
     * @param string $message Message to log.
     */
    public function addWrongLogstashLog($message)
    {
        $this->addLog($message, 'WrongLogstashTarget');
    }

    /**
     * @param string $message Message to log.
     */
    public function addWrongRedisLog($message)
    {
        $this->addLog($message, 'WrongRedisTarget');
    }

    public function dontSeeEmergencyLog()
    {
        $logFile = \Yii::getAlias(self::EMERGENCY_LOG);
        $this->assertFalse(file_exists($logFile));
    }

    public function flushElasticsearch()
    {
        $curl = curl_init('http://localhost:9200/yii');
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'DELETE');
        curl_exec($curl);
        curl_close($curl);
    }

    public function flushRedis()
    {
        $client = new PredisClient();
        $client->flushall();
    }

    public function removeEmergencyLog()
    {
        $logFile = \Yii::getAlias(self::EMERGENCY_LOG);
        if (file_exists($logFile) === true) {
            unlink($logFile);
        }
    }

    public function removeLogstashFile()
    {
        $logFile = \Yii::getAlias(self::LOGSTASH_FILE_LOG);
        if (file_exists($logFile) === true) {
            unlink($logFile);
        }
    }

    /**
     * @param string $message Message to log.
     */
    public function seeElasticsearchLog($message)
    {
        $client = ESClient::connection('http://127.0.0.1:9200/yii/log');
        $result = $client->search([]);
        $this->assertEquals($message, $result['hits']['hits'][0]['_source']['@message']);
    }

    /**
     * @param string $message Message to log.
     */
    public function seeEmergencyLog($message)
    {
        $content = file_get_contents(\Yii::getAlias(self::EMERGENCY_LOG));
        $content = json_decode(trim($content), true);

        $this->assertEquals($content['@message'], $message);
        $this->assertTrue(isset($content['emergency']));
    }

    public function seeLogstashFile()
    {
        $logFile = \Yii::getAlias(self::LOGSTASH_FILE_LOG);
        $this->assertTrue(file_exists($logFile));
    }

    /**
     * @param string $message Message to log.
     */
    public function seeRedisLog($message)
    {
        $client = new PredisClient();
        $this->assertEquals(1, $client->llen(self::REDIS_LOG));

        $log = json_decode($client->lpop(self::REDIS_LOG), true);

        $this->assertEquals($message, $log['@message']);
    }

    /**
     * @param string|string[] $messages Message to log.
     * @param string          $target   Name of log target.
     */
    protected function addLog($messages, $target)
    {
        if (gettype($messages) === 'string') {
            $messages = [$messages];
        }
        foreach ($messages as $message) {
            \Yii::error($message, $target);
        }

        \Yii::$app->getLog()->flush(true);
    }
}
