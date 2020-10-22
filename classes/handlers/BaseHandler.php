<?php

namespace Grav\Plugin\LoggerChannels\Handlers;

abstract class BaseHandler implements HandlerInterface
{
    /** @var string */
    protected $name;

    public function getName()
    {
        return $this->name;
    }
}
