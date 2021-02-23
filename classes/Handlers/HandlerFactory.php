<?php

namespace Grav\Plugin\LoggerChannels\Handlers;

class HandlerFactory
{
    /**
     * @param string $handler
     * @param array  $options
     * @return HandlerInterface
     */
    public static function create(string $handler, array $options = [])
    {
        $handlerClassname = 'Grav\\Plugin\\LoggerChannels\\Handlers\\' . ucfirst($handler) . 'Handler';

        /** @var HandlerInterface $class */
        $class = new $handlerClassname();
        $class->initHandler($options);
        return $class;
    }
}
