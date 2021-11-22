<?php

namespace Grav\Plugin\LoggerChannels\Handlers;

class DiscordHandler extends BaseHandler
{
    protected $name = 'Discord';

    public function initHandler(array $options)
    {
        $this->handler = new \Strate\Monolog\Handler\DiscordHandler($options['webhook'], $options['level']);
    }
}
