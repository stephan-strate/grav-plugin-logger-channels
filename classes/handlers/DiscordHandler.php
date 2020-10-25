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
        $config = Grav::instance()['config'];
        $this->handler = new \DiscordHandler\DiscordHandler($options['webhook'], 'grav', $config->get('site.title'), $options['level']);
    }

    public static function getConfigs()
    {
        /** @var Config $config */
        $config = Grav::instance()['config'];
        return $config->get('plugin.logger-channels.handlers.discord', []);
    }
}
