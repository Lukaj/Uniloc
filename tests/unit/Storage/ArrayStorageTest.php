<?php

namespace Lukaj\Uniloc\Test\Storage;

use Lukaj\Uniloc\Test\BaseCase;
use Lukaj\Uniloc\Storage\ArrayStorage;
use Lukaj\Uniloc\LangTag;

class ArrayStorageTest extends BaseCase
{
    /**
     * @covers ArrayStorage::__construct
     * @covers ArrayStorage::load
     */
    public function testStorage ()
    {
        $storage = new ArrayStorage(array(
                'apples' => 'Apples',
                'pears' => array ('red' => 'Red', 'yellow' => 'Yellow')
            ));
        $arr = $storage->load(new LangTag('cs-CZ'));

        $this->assertSame('Apples', $arr['apples']);
        $this->assertSame('Yellow', $arr['pears.yellow']);
    }
}