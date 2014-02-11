<?php
/**
 * @link      https://github.com/index0h/yii-log
 * @copyright Copyright (c) 2014 Roman Levishchenko <index.0h@gmail.com>
 * @license   https://raw.github.com/index0h/yii-log/master/LICENSE
 */

namespace index0h\yii\log;

use index0h\yii\log\base\EmergencyTrait;
use index0h\yii\log\base\TargetTrait;
use Predis\Client;
use yii\log\Target;

class RedisTarget extends Target
{
    use TargetTrait;
    use EmergencyTrait;

    /** @type string Redis list key. */
    public $key = 'yiiLog';

    /** @type array|null Predis client options, @see https://github.com/nrk/predis. */
    public $options;

    /** @type array|null Predis client parameters, @see https://github.com/nrk/predis. */
    public $parameters;

    /**
     * @inheritdoc
     */
    public function export()
    {
        try {
            $client = new Client($this->parameters, $this->options);
            $client->lpush($this->key, array_map([$this, 'formatMessage'], $this->messages));
        } catch (\Exception $error) {
            $this->emergencyExport(
                [
                    'key' => $this->key,
                    'error' => $error->getMessage(),
                    'errorNumber' => $error->getCode(),
                    'trace' => $error->getTraceAsString()
                ]
            );
        }
    }
}
