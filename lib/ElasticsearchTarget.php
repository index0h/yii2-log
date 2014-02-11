<?php
/**
 * @link      https://github.com/index0h/yii-log
 * @copyright Copyright (c) 2014 Roman Levishchenko <index.0h@gmail.com>
 * @license   https://raw.github.com/index0h/yii-log/master/LICENSE
 */

namespace index0h\yii\log;

use ElasticSearch\Client;
use index0h\yii\log\base\EmergencyTrait;
use index0h\yii\log\base\TargetTrait;
use yii\log\Target;

/**
 * @author Roman Levishchenko <index.0h@gmail.com>
 */
class ElasticsearchTarget extends Target
{
    use TargetTrait;
    use EmergencyTrait;

    /** @type array Elasticsearch full url @see https://github.com/nervetattoo/elasticsearch. */
    public $dsn = 'http://127.0.0.1:9200/yii/log';

    /**
     * @inheritdoc
     */
    public function export()
    {
        try {
            $client = Client::connection($this->dsn);

            foreach ($this->messages as &$message) {
                $client->index($this->formatMessage($message));
            }
        } catch (\Exception $error) {
            $this->emergencyExport(
                [
                    'dsn' => $this->dsn,
                    'error' => $error->getMessage(),
                    'errorNumber' => $error->getCode(),
                    'trace' => $error->getTraceAsString()
                ]
            );
        }
    }
}
