<?php

namespace Grav\Plugin\LoggerChannels\Handlers;

use Monolog\Handler\GelfHandler;
use Monolog\Handler\NullHandler;
use Monolog\Formatter\GelfMessageFormatter;
use Gelf\Publisher;
use Gelf\Transport\TcpTransport;
use Gelf\Transport\UdpTransport;
use Gelf\Message;

/**
 * Append a defined set of extra fields to every message.
 * Used to pass a Graylog authentication token.
 */
class GelfMessagePrefixer extends GelfMessageFormatter
{
    protected $extraFields = [];

    public function setExtraFields(array $extraFields): void
    {
        $this->extraFields = $extraFields;
    }

    public function format(array $record): Message
    {
        if (isset($record['extra']) && is_array($record['extra']) && $this->extraFields) {
            $record['extra'] = array_merge($record['extra'], $this->extraFields);
        }

        return parent::format($record);
    }
}

class GraylogHandler extends BaseHandler
{
    protected $name = 'Graylog';

    public function initHandler(array $options)
    {
        // fail-safe if graylog2/gelf-php is not installed
        if (! class_exists('Gelf\Publisher')) {
            $this->handler = new NullHandler();
            return;
        }

        // Setup transport
        $transport = $options['host'] === 'tcp'
            ? new TcpTransport($options['host'], $options['port'])
            : new UdpTransport($options['host'], $options['port']);
        // Useful for debugging message with tcpdump
        // $transport->setMessageEncoder(new \Gelf\Encoder\JsonEncoder());

        // Setup publisher
        $publisher = new Publisher($transport);

        // Setup formatter
        $formatter = new GelfMessagePrefixer();
        $extraFields = [];
        array_walk($options['extra_fields'], function ($item) use (&$extraFields) {
            $extraFields[$item['key']] = $item['value'];
        });
        $formatter->setExtraFields($extraFields);

        // Setup handler
        $this->handler = new GelfHandler($publisher, $options['level']);
        $this->handler->setFormatter($formatter);
    }
}
