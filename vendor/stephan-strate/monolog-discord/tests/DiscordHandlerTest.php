<?php

namespace Strate\Monolog\Handler;

use Monolog\Logger;
use Monolog\Test\TestCase;

class DiscordHandlerTest extends TestCase
{

    public function testGetMessageShort()
    {
        $handler = new DiscordHandler('https://discord.com/api/webhooks/{webhook.id}/{webhook.token}', Logger::WARNING);
        $record = $this->getRecord(Logger::WARNING, 'Short dummy message');

        $this->assertEquals(
            ['content' => 'Short dummy message'],
            $handler->getMessage($record),
        );
    }
}
