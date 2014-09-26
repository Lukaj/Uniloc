<?php

namespace Lukaj\Uniloc\Test\Formatter;

use Lukaj\Uniloc\Test\BaseCase;
use Lukaj\Uniloc\BaseTestCase;
use Lukaj\Uniloc\Formatter\BlankFormatter;

class BlankFormatterTest extends BaseCase
{
    /**
     * BlankFormatter::format
     */
    public function testFormat ()
    {
        $fmt = new BlankFormatter();

        $this->assertSame('86400_seconds_in_day', $fmt->format('86400_seconds_in_day'));
    }
}