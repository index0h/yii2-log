<?php
/**
 * @link      https://github.com/index0h/yii-log
 * @copyright Copyright (c) 2014 Roman Levishchenko <index.0h@gmail.com>
 * @license   https://raw.github.com/index0h/yii-log/master/LICENSE
 */

return [
    'id' => 'basic',
    'basePath' => \Yii::getAlias('@tests'),
    'runtimePath' => \Yii::getAlias('@tests/_runtime'),
    'components' => [
        'log' => [
            'traceLevel' => 3,
            'targets' => [
                [
                    'class' => 'index0h\\yii\\log\\ElasticsearchTarget',
                    'categories' => ['ElasticsearchTarget'],
                    'emergencyLogFile' => '@tests/_log/emergency.log'
                ],
                [
                    'class' => 'index0h\\yii\\log\\ElasticsearchTarget',
                    'categories' => ['WrongElasticsearchTarget'],
                    'dsn' => 'http://WRONG_HOST:12045/yii/log',
                    'emergencyLogFile' => '@tests/_log/emergency.log'
                ],
                [
                    'class' => 'index0h\\yii\\log\\LogstashFileTarget',
                    'categories' => ['LogstashFileTarget'],
                    'logFile' => '@tests/_log/logstash.log'
                ],
                [
                    // Travis doesn't have logstash implementation.
                    'class' => 'index0h\\yii\\log\\LogstashTarget',
                    'categories' => ['WrongLogstashTarget'],
                    'dsn' => 'tcp://WRONG_HOST:12045',
                    'emergencyLogFile' => '@tests/_log/emergency.log'
                ],
                [
                    'class' => 'index0h\\yii\\log\\RedisTarget',
                    'categories' => ['RedisTarget'],
                    'emergencyLogFile' => '@tests/_log/emergency.log',
                    'key' => 'yii_log'
                ],
                [
                    'class' => 'index0h\\yii\\log\\RedisTarget',
                    'categories' => ['WrongRedisTarget'],
                    'parameters' => 'tcp://WRONG_HOST:12045',
                    'emergencyLogFile' => '@tests/_log/emergency.log'
                ],
            ],
        ],
    ]
];