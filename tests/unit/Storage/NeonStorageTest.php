<?php

namespace Lukaj\Uniloc\Test\Storage;

use Lukaj\Uniloc\Test\BaseCase;
use Lukaj\Uniloc\Storage\NeonStorage;
use Lukaj\Uniloc\LangTag;

class NeonStorageTest extends BaseCase
{
    /**
     * @covers NeonStorage::__construct
     * @covers NeonStorage::load
     */
    public function testStorage ()
    {
        $storage = new NeonStorage('./tests/helpers/NeonStorage_[language].neon');
        $msgs = $storage->load(new LangTag('en-US'));

        $this->assertSame('Me', $msgs['main.me']);
    }
}