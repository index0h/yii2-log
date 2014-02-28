<?php
/**
 * @link      https://github.com/index0h/yii2-log
 * @copyright Copyright (c) 2014 Roman Levishchenko <index.0h@gmail.com>
 * @license   https://raw.github.com/index0h/yii2-log/master/LICENSE
 */

defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'dev');

require_once __DIR__ . implode(DIRECTORY_SEPARATOR, ['', '..', 'vendor', 'autoload.php']);
require_once __DIR__ . implode(DIRECTORY_SEPARATOR, ['', '..', 'vendor', 'yiisoft', 'yii2', 'Yii.php']);

Yii::setAlias('@tests', __DIR__);
Yii::setAlias('@runtime', __DIR__ . DIRECTORY_SEPARATOR . '_runtime');

$configuration = require __DIR__ . DIRECTORY_SEPARATOR . 'unit' . DIRECTORY_SEPARATOR . '_config.php';

$application = new yii\console\Application($configuration);
