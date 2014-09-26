<?php

namespace Lukaj\Uniloc\Test\Storage;

use Lukaj\Uniloc\Test\BaseCase;
use Lukaj\Uniloc\Storage\FileArrayStorage;
use Lukaj\Uniloc\LangTag;

class FileArrayStorageTest extends BaseCase
{
    /**
     * @covers FileArrayStorage::__construct
     * @covers FileArrayStorage::load
     */
    public function testStorage ()
    {
        $storage = new FileArrayStorage('./tests/helpers/FileArrayStorage_[language].php');
        $msgs = $storage->load(new LangTag('en-US'));

        $this->assertSame('Hello', $msgs['hello.age']);
    }
}