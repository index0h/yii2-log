<?php
/**
 * @link      https://github.com/index0h/yii-log
 * @copyright Copyright (c) 2014 Roman Levishchenko <index.0h@gmail.com>
 * @license   https://raw.github.com/index0h/yii-log/master/LICENSE
 */

namespace index0h\yii\log;

use index0h\yii\log\base\TargetTrait;

/**
 * @author Roman Levishchenko <index.0h@gmail.com>
 */
class LogstashFileTarget extends \yii\log\FileTarget
{
    use TargetTrait;
}
