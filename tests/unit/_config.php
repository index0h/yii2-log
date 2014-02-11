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
                ['class' => 'index0h\\yii\\log\\ElasticsearchTarget'],
                ['class' => 'index0h\\yii\\log\\LogstashFileTarget'],
                ['class' => 'index0h\\yii\\log\\LogstashTarget'],
                ['class' => 'index0h\\yii\\log\\RedisTarget'],
            ],
        ],
    ]
];