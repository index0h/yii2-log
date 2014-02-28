<?php
/**
 * @link      https://github.com/index0h/yii2-log
 * @copyright Copyright (c) 2014 Roman Levishchenko <index.0h@gmail.com>
 * @license   https://raw.github.com/index0h/yii2-log/master/LICENSE
 */

namespace index0h\log;

use index0h\log\base\TargetTrait;

/**
 * @author Roman Levishchenko <index.0h@gmail.com>
 */
class LogstashFileTarget extends \yii\log\FileTarget
{
    use TargetTrait;
}
