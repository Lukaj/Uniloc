<?php

namespace Lukaj\Uniloc\Test\Formatter;

use Lukaj\Uniloc\Test\BaseCase;
use Lukaj\Uniloc\BaseTestCase;
use Lukaj\Uniloc\Formatter\MessageFormatter;
use Lukaj\Uniloc\LangTag;

class MessageFormatterTest extends BaseCase
{
    /**
     * SprintfFormatter::format
     */
    public function testFormat ()
    {
        $fmt = new MessageFormatter();

        $fmt->setLocale(new LangTag('en-US'));

        $this->assertSame('25 and fight', $fmt->format('{0, number} and {1}', array(0 => 25, 1 => 'fight')));
    }
}