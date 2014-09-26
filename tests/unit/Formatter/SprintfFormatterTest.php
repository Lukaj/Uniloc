<?php

namespace Lukaj\Uniloc\Test\Formatter;

use Lukaj\Uniloc\Test\BaseCase;
use Lukaj\Uniloc\BaseTestCase;
use Lukaj\Uniloc\Formatter\SprintfFormatter;

class SprintfFormatterTest extends BaseCase
{
    /**
     * SprintfFormatter::format
     */
    public function testFormat ()
    {
        $fmt = new SprintfFormatter();

        $this->assertSame('25 and fight', $fmt->format('%d and %s', array(25, 'fight')));
    }
}