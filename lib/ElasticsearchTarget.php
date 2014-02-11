<?php
/**
 * @link      https://github.com/index0h/yii-log
 * @copyright Copyright (c) 2014 Roman Levishchenko <index.0h@gmail.com>
 * @license   https://raw.github.com/index0h/yii-log/master/LICENSE
 */

namespace index0h\yii\log;

use Elasticsearch\Client;
use index0h\yii\log\base\EmergencyTrait;
use index0h\yii\log\base\TargetTrait;
use yii\log\Target;
use Yii;

class ElasticsearchTarget extends Target
{
    use TargetTrait;
    use EmergencyTrait;

    /** @type string Index name. */
    public $index;

    /** @type array Elasticsearch client options @see https://github.com/elasticsearch/elasticsearch-php. */
    public $options;

    /** @type string Index type. */
    public $type = 'yiiLog';

    /**
     * @inheritdoc
     */
    public function export()
    {
        try {
            $client = new Client();

            $data = [
                'index' => $this->index,
                'type' => $this->type,
                'body' => implode("\n", array_map([$this, 'formatMessage'], $this->messages)) . "\n"
            ];

            $client->bulk($data);
        } catch (\Exception $error) {
            $this->emergencyExport(
                [
                    'index' => $this->index,
                    'type' => $this->type,
                    'error' => $error->getMessage(),
                    'errorNumber' => $error->getCode(),
                    'trace' => $error->getTraceAsString()
                ]
            );
        }
    }
}
