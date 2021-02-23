<?php

namespace Grav\Plugin\LoggerChannels\Handlers;

use Grav\Common\Config\Config;
use Grav\Common\Grav;

class DiscordHandler extends BaseHandler
{
    protected $name = 'Discord';

    public function initHandler(array $options)
    {
        /** @var Config $config */
        $config = Grav::instance()->get('config');
        $this->handler = new \DiscordHandler\DiscordHandler($options['webhook'], 'grav', $config->get('site.title'), $options['level']);
    }
}
