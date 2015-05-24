<?php
/**
 * @link      https://github.com/index0h/yii2-log
 * @copyright Copyright (c) 2014 Roman Levishchenko <index.0h@gmail.com>
 * @license   https://raw.github.com/index0h/yii2-log/master/LICENSE
 */

namespace index0h\log;

use index0h\log\base\EmergencyTrait;
use index0h\log\base\TargetTrait;

/**
 * @author Roman Levishchenko <index.0h@gmail.com>
 */
class LogstashTarget extends \yii\log\Target
{
    use TargetTrait;
    use EmergencyTrait;

    /** @var string Connection configuration to Logstash. */
    public $dsn = 'tcp://localhost:3333';

    /**
     * @inheritdoc
     */
    public function export()
    {
        try {
            $socket = stream_socket_client($this->dsn, $errorNumber, $error, 30);

            foreach ($this->messages as &$message) {
                fwrite($socket, $this->formatMessage($message) . "\r\n");
            }

            fclose($socket);
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
