<?php
/**
 * @link      https://github.com/index0h/yii2-log
 * @copyright Copyright (c) 2014 Roman Levishchenko <index.0h@gmail.com>
 * @license   https://raw.github.com/index0h/yii2-log/master/LICENSE
 */

return [
    'id' => 'basic',
    'basePath' => \Yii::getAlias('@tests'),
    'runtimePath' => \Yii::getAlias('@tests/_runtime'),
    'bootstrap' => ['log'],
    'components' => [
        'redis' => ['class' => 'yii\redis\Connection'],
        'elasticsearch' => ['class' => 'yii\elasticsearch\Connection'],
        'log' => [
            'traceLevel' => 3,
            'targets' => [
                [
                    'class' => 'index0h\\log\\ElasticsearchTarget',
                    'categories' => ['ElasticsearchTarget'],
                    'emergencyLogFile' => '@tests/_log/emergency.log'
                ],
                [
                    'class' => 'index0h\\log\\ElasticsearchTarget',
                    'categories' => ['WrongElasticsearchTarget'],
                    'componentName' => 'WRONG',
                    'emergencyLogFile' => '@tests/_log/emergency.log'
                ],
                [
                    'class' => 'index0h\\log\\LogstashFileTarget',
                    'categories' => ['LogstashFileTarget'],
                    'logFile' => '@tests/_log/logstash.log'
                ],
                [
                    // Travis doesn't have logstash implementation.
                    'class' => 'index0h\\log\\LogstashTarget',
                    'categories' => ['WrongLogstashTarget'],
                    'dsn' => 'tcp://WRONG_HOST:12045',
                    'emergencyLogFile' => '@tests/_log/emergency.log'
                ],
                [
                    'class' => 'index0h\\log\\RedisTarget',
                    'categories' => ['RedisTarget'],
                    'emergencyLogFile' => '@tests/_log/emergency.log',
                    'key' => 'yii_log'
                ],
                [
                    'class' => 'index0h\\log\\RedisTarget',
                    'categories' => ['WrongRedisTarget'],
                    'componentName' => 'WRONG',
                    'emergencyLogFile' => '@tests/_log/emergency.log'
                ],
            ],
        ],
    ]
];