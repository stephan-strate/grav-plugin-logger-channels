<?php

namespace Grav\Plugin\LoggerChannels\Handlers;

use Monolog\Handler\AbstractProcessingHandler;

abstract class BaseHandler implements HandlerInterface
{
    /** @var string */
    protected $name;

    /** @var AbstractProcessingHandler */
    protected $handler;

    public function getName()
    {
        return $this->name;
    }

    public function getHandler()
    {
        return $this->handler;
    }
}
