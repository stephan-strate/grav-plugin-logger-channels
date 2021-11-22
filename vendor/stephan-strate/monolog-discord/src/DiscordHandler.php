<?php

/**
 * This file is part of the Monolog Discord handler created by Stephan Strate.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Stephan Strate <hello@stephan.codes>
 * @link https://github.com/stephan-strate/monolog-discord
 * @copyright (c) 2021, Stephan Strate
 * @version 0.0.1
 */

namespace Strate\Monolog\Handler;

use Monolog\Handler\AbstractProcessingHandler;
use Monolog\Logger;

/**
 * DiscordHandler uses cURL to trigger Discord webhook.
 * Register new webhook: https://support.discord.com/hc/en-us/articles/228383668-Intro-to-Webhooks
 *
 * @see https://support.discord.com/hc/en-us/articles/228383668-Intro-to-Webhooks
 */
class DiscordHandler extends AbstractProcessingHandler
{

    /**
     * Discord limits the message length to
     * @see https://discord.com/developers/docs/resources/webhook#execute-webhook-jsonform-params
     */
    const MAX_MESSAGE_LENGTH = 2000;

    /**
     * @var string
     */
    protected string $webhook;

    /**
     * @param string $webhook   webhook url
     * @param int|string $level minimum logging level at which this handler will be triggered
     * @param bool $bubble      whether the messages that are handled can bubble up the stack or not
     */
    public function __construct(string $webhook, $level = Logger::DEBUG, bool $bubble = true)
    {
        $this->webhook = $webhook;
        parent::__construct($level, $bubble);
    }

    /**
     * Generate discord compatible webhook message.
     *
     * @param array $record record passthrough from {@link write}
     * @return array
     *
     * @see https://discord.com/developers/docs/resources/webhook#execute-webhook
     */
    public function getMessage(array $record): array
    {
        $content = $record['message'];

        // truncate message as discords message limit is 2000 characters
        if (strlen($content) > self::MAX_MESSAGE_LENGTH) {
            $countRemovedCharacters = strlen($content) - (self::MAX_MESSAGE_LENGTH + 32);
            $content = substr($content, 0, self::MAX_MESSAGE_LENGTH - 32) . " (removed $countRemovedCharacters characters)";
        }

        return [
            'content' => $content,
        ];
    }

    /**
     * {@inheritDoc}
     */
    protected function write(array $record): void
    {
        $message = json_encode($this->getMessage($record));

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->webhook);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $message);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'Content-Length: '. strlen($message),
        ]);

        curl_exec($ch);
    }
}
