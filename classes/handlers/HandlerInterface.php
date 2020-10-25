<?php

namespace Grav\Plugin\LoggerChannels\Handlers;

use Monolog\Handler\AbstractProcessingHandler;

interface HandlerInterface
{
    public function initHandler(array $options);

    /**
     * @return string
     */
    public function getName();

    /**
     * @return AbstractProcessingHandler
     */
    public function getHandler();

    public static function getConfigs();
}
