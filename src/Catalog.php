<?php

namespace Lukaj\Uniloc;

use Nette\Caching\Cache;
use Lukaj\Uniloc\Formatter\IFormatter;

/**
 * @author Lukas Mazur
 */
class Catalog
{
    /** @var Cache */
    private $cache;

    /** @var IFormatter[] */
    private $formatters;

    /**
     * @internal Catalog should be created by CatalogFactory::create()
     *
     * @param LangTag $langtag
     * @param Cache   $cache
     */
    public function __construct (Cache $cache)
    {
        $this->cache = $cache;
        $this->formatters = $cache->load('__formatters');
    }

    /**
     * @param string $msgid Message id
     *
     * @return array|NULL ['fmt' => IFormatter, 'msg' => string] or NULL if $msgid not found
     */
    public function getMessage ($msgid)
    {
        $msg = $this->cache->load($msgid);
        $msg['fmt'] = $this->formatters[$msg['fmt']];

        return $msg;
    }
}