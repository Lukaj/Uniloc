<?php

namespace Lukaj\Uniloc\Test;

use Lukaj\Uniloc\Test\BaseCase;
use Lukaj\Uniloc\LangTag as LT;

class LangTagTest extends BaseCase
{
    /** @var LT */
    private $lt;

    protected function setUp ()
    {
        $this->lt = new LT('ru-Cyrl-RU');
    }

    /**
     * @covers LT::__construct
     */
    public function testConstructorArgs ()
    {
        $this->setExpectedException('LogicException');

        $parser = new LT('invalid-tag');
    }

    /**
     * @covers LT::getTag
     * @covers LT::getLanguage
     * @covers LT::getScript
     * @covers LT::getRegion
     * @covers LT::__toString
     */
    public function testGetters ()
    {
        $this->assertSame('ru-Cyrl-RU', $this->lt->getTag());
        $this->assertSame('ru', $this->lt->getLanguage());
        $this->assertSame('Cyrl', $this->lt->getScript());
        $this->assertSame('RU', $this->lt->getRegion());
        $this->assertSame('ru-Cyrl-RU', (string)$this->lt);
    }

    /**
     * @covers LT::getNextFallback
     */
    public function testFallbacks ()
    {
        $lt = clone $this->lt;
        $this->assertSame('ru-Cyrl-RU', $lt->getTag());
        $lt = $lt->getNextFallback();
        $this->assertSame('ru-Cyrl', $lt->getTag());
        $lt = $lt->getNextFallback();
        $this->assertSame('ru', $lt->getTag());
        $lt = $lt->getNextFallback();
        $this->assertNull($lt);
    }

    /**
     * @covers LT::from
     */
    public function testFrom ()
    {
        $this->assertSame($this->lt, LT::from($this->lt));

        $lt = LT::from('fr-FR');
        $this->assertTrue($lt instanceof LT);
        $this->assertSame('fr-FR', $lt->getTag());

        $this->setExpectedException('LogicException');
        LT::from('latin-rome');
    }

    /**
     * @covers LT::__construct
     * @covers LT::replaceSeparator
     */
    public function testSeparator ()
    {
        $this->assertSame('ru-RU', LT::replaceSeparator('ru_RU'));

        $this->setExpectedException('LogicException');
        $lt = new LT('ru_RU');
    }
}