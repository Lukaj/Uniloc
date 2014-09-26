<?php

use Lukaj\Uniloc\CatalogFactory as CF;
use Lukaj\Uniloc\Formatter\BlankFormatter;
use Lukaj\Uniloc\Storage\ArrayStorage;
use Lukaj\Uniloc\LangTag;
use Lukaj\Uniloc\Test\BaseCase;
use Nette\Caching\Storages\MemoryStorage;

class CatalogFactoryTest extends BaseCase
{
    /** @var CatalogFactory */
    private $catalogFactory;

    protected function setUp ()
    {
        $this->catalogFactory = new CF(new MemoryStorage());
        $this->catalogFactory->addResource(new BlankFormatter(), new ArrayStorage(array(
                'oner' => 'One',
                'two'  => 'Two',
                'three'    => 'Three'
            )));
    }

    /**
     * @covers CatalogFactory::create
     */
    public function testCreation ()
    {
        $catalog = $this->catalogFactory->create(new LangTag('en-US'));

        $msg = $catalog->getMessage('two');
        $this->assertSame('Two', $msg['msg']);
        $this->assertTrue($msg['fmt'] instanceof BlankFormatter);
    }

}