<?php

namespace Lukaj\Uniloc\Test;

use Lukaj\Uniloc\Test\BaseCase;
use Lukaj\Uniloc\Catalog;
use Nette\Caching\Cache;
use Nette\Caching\Storages\MemoryStorage;

class CatalogTest extends BaseCase
{
    /** @var Cache */
    private $catalog;

    protected function setUp()
    {
        $cache = new Cache(new MemoryStorage());
        $cache->save('hello', array('msg' => 'Hello', 'fmt' => 0));
        $cache->save('one.two', array('msg' => 'One', 'fmt' => 1));
        $cache->save('__formatters', array('first', 'second'));

        $this->catalog = new Catalog($cache);
    }

    /**
     * @covers Catalog::getMessage
     */
    public function testDataRetrieval ()
    {
        $this->assertSame(array(
                'msg' => 'Hello',
                'fmt' => 'first'
            ), $this->catalog->getMessage('hello'));
        $this->assertSame(array(
                'msg' => 'One',
                'fmt' => 'second'
            ), $this->catalog->getMessage('one.two'));
    }
}