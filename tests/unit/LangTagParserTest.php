<?php

namespace Lukaj\Uniloc\Test;

use stdClass;
use Lukaj\Uniloc\Test\BaseCase;
use Lukaj\Uniloc\LangTagParser as Parser;

class LangTagParserTest extends BaseCase
{
    /**
     * @covers LangTagParser::__construct
     */
    public function testStaticClass ()
    {
        $this->setExpectedException('LogicException');
        $parser = new Parser();
    }

    /**
     * @covers LangTagParser::parse
     */
    public function testParse ()
    {
        $this->assertNull(Parser::parse(new stdClass));
        $this->assertNull(Parser::parse(1789));
        $this->assertNull(Parser::parse(''));

        $this->assertNull(Parser::parse('en-US-'));
        $this->assertNull(Parser::parse('-en-US'));

        $this->assertSame(array(
                'language'  => 'en',
                'script'    => 'Latn',
                'region'    => 'US',
                'variant0' => 'Modern',
                'variant1' => 'Extra'
            ), Parser::parse('en-Latn-US-Modern-Extra'));

        $this->assertSame(array('language' => 'en'), Parser::parse('en'));
        $this->assertSame(array('language' => 'en', 'script' => 'Latn'), Parser::parse('en-Latn'));
        $this->assertSame(array('language' => 'eng', 'region' => 'US'), Parser::parse('eng-US'));
        $this->assertSame(array('language' => 'en', 'region' => 'US', 'variant0' => 'Var'), Parser::parse('en-US-Var'));
        $this->assertSame(array('language' => 'en', 'variant0' => 'Var'), Parser::parse('en-Var'));

        $this->assertNull(Parser::parse('EN-US'));
    }
}