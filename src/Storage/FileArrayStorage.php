<?php

namespace Lukaj\Uniloc\Storage;

use Lukaj\Uniloc\Storage\IStorage;
use Lukaj\Uniloc\Helpers;
use Lukaj\Uniloc\LangTag;

/**
 * @author Lukas Mazur
 */
class FileArrayStorage implements IStorage
{
    public function __construct ($pathMask = 'locale/lang/[tag].php', $arrayName = 'lang')
    {
        $this->pathMask = $pathMask;
        $this->arrayName = $arrayName;
    }

    /**
     * {@inheritDoc}
     */
    public function load(LangTag $langtag, $domain = NULL)
    {
        require Helpers::parseStorageFilename($langtag, $this->pathMask, $domain);
        return Helpers::arrayToDomain(${$this->arrayName});
    }
}