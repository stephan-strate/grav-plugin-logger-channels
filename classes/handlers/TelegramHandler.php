<?php

namespace Grav\Plugin\LoggerChannels\Handlers;

use Grav\Common\Config\Config;
use Grav\Common\Grav;

class TelegramHandler extends BaseHandler
{
    protected $name = 'Telegram';

    public function initHandler(array $options)
    {
        $this->handler = new \Mero\Monolog\Handler\TelegramHandler($options['token'], $options['chatid'], $options['level']);
    }

    public static function getConfigs()
    {
        /** @var Config $config */
        $config = Grav::instance()['config'];
        return $config->get('plugin.logger-channels.handlers.telegram', []);
    }
}
