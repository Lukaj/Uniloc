<?php

namespace Lukaj\Uniloc\Storage;

use LogicException;
use Nette\Neon\Neon;
use Lukaj\Uniloc\Storage\IStorage;
use Lukaj\Uniloc\Helpers;
use Lukaj\Uniloc\LangTag;

/**
 * @author Lukas Mazur
 */
class NeonStorage implements IStorage
{
    /** @var string */
    private $pathMask;

    /**
     * @param string $pathMask
     */
    public function __construct ($pathMask = 'locale/messages/[tag].neon')
    {
        if (!class_exists('\Nette\Neon\Neon')) {
            throw new LogicException('Neon storage is not supported. Please install package nette/neon via composer.');
        }
        $this->pathMask = $pathMask;
    }

    /**
     * {@inheritDoc}
     */
    public function load(LangTag $langtag, $domain = null)
    {
        $filename = Helpers::parseStorageFilename($langtag, $this->pathMask, $domain);
        $neon = Neon::decode(file_get_contents($filename));
        return Helpers::arrayToDomain($neon);
    }
}
