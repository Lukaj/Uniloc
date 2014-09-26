<?php

namespace Lukaj\Uniloc\Test;

use Lukaj\Uniloc\Test\BaseCase;
use Lukaj\Uniloc\LangTag;
use Lukaj\Uniloc\Helpers;

class HelpersTest extends BaseCase
{
    /**
     * @covers Helpers::parseStorageFilename
     */
    public function testPathReplacement ()
    {
        $lt = new LangTag('en-Latn-US');

        $this->assertSame('en-Latn-USUSLatnenSomething', Helpers::parseStorageFilename($lt, '[tag][region][script][language][domain]', 'Something'));
        $this->assertSame('[one]two[en]free', Helpers::parseStorageFilename($lt, '[one]two[[language]]free', NULL));
    }

    /**
     * @covers Helpers::arrayToDomain
     */
    public function testArrayToDomain ()
    {
        $array = array(
                'roman' => array(
                    'caesar' => array('augustus' => 'Augustus', 'hadrian' => 'Hadrian'),
                    'writer' => array('publius_ovidius' => 'Publius Ovidius', 'cicero' => 'Cicero')
                ),
                'greek' => 'Epictetus'
            );
        $domain = array(
                'roman.caesar.augustus' => 'Augustus',
                'roman.caesar.hadrian' => 'Hadrian',
                'roman.writer.publius_ovidius' => 'Publius Ovidius',
                'roman.writer.cicero' => 'Cicero',
                'greek' => 'Epictetus',
            );
        $this->assertSame($domain, Helpers::arrayToDomain($array));
    }
}