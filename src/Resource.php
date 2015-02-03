<?php

namespace Lukaj\Uniloc;

use SplFileInfo;
use Lukaj\Uniloc\LangTag;
use Lukaj\Uniloc\Formatter\IFormatter;
use Lukaj\Uniloc\Storage\IStorage;

/**
 * @internal
 *
 * @author Lukas Mazur
 */
class Resource
{
    /** @var IFormatter */
    private $formatter;

    /** @var IStorage */
    private $storage;


    /**
     * @param IFormatter $formatter
     * @param IStorage   $storage
     */
    public function __construct (IFormatter $formatter, IStorage $storage)
    {
        $this->formatter = $formatter;
        $this->storage = $storage;
    }

    /**
     * @return array [string => string]
     */
    public function getAllMessages (LangTag $langtag)
    {
        $messages = array();

        do {
            $messages += $this->storage->load($langtag);
        } while ($langtag = $langtag->getNextFallback());

        return $messages;
    }

    /**
     * @return IFormatter
     */
    public function getFormatter ()
    {
        return $this->formatter;
    }

    /**
     * @return SplFileInfo
     */
    public function getFile ()
    {
        return new SplFileInfo('test');
    }
}