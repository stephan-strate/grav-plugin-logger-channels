<?php

namespace Grav\Plugin\LoggerChannels\Handlers;

interface HandlerInterface
{
    public function initHandler(array $options);

    /**
     * @return string
     */
    public function getName();
}
