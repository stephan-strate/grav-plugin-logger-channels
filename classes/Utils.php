<?php

namespace Grav\Plugin\LoggerChannels;

use Grav\Common\Inflector;
use Monolog\Logger;

final class Utils
{
    /**
     * Generate array with {@link Logger} levels as key and
     * log level pretty names as value.
     * @return array
     */
    public static function levelsOptions(): array
    {
        $keys = Logger::getLevels();
        $values = array_map(function ($level) {
            $name = Logger::getLevelName($level);
            return Inflector::titleize($name);
        }, $keys);
        return array_combine($keys, $values);
    }
}
