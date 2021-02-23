<?php

namespace Grav\Plugin\LoggerChannels\Handlers;

class TelegramHandler extends BaseHandler
{
    protected $name = 'Telegram';

    public function initHandler(array $options)
    {
        $this->handler = new \Mero\Monolog\Handler\TelegramHandler($options['token'], $options['chatid'], $options['level']);
    }
}
