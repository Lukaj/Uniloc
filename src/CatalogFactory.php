<?php

namespace Lukaj\Uniloc;

use Nette\Caching\IStorage as ICacheStorage;
use Nette\Caching\Storages\FileStorage;
use Nette\Caching\Cache;
use Lukaj\Uniloc\Catalog;
use Lukaj\Uniloc\Formatter\IFormatter;
use Lukaj\Uniloc\Formatter\MessageFormatter;
use Lukaj\Uniloc\Storage\IStorage;
use Lukaj\Uniloc\Storage\NeonStorage;
use Lukaj\Uniloc\Resource;

/**
 * @author Lukas Mazur
 */
class CatalogFactory
{
    /**
     * @internal
     *
     * @var string
     */
    const CACHE_NAMESPACE = 'Lukaj.Uniloc';

    /**
     * @internal
     *
     * @var string
     */
    const CACHE_KEY_COMPILED = '__compiled';

    /**
     * @internal
     *
     * @var string
     */
    const CACHE_KEY_FMTS = '__formatters';

    /** @var Resource[] */
    private $resources = array();

    /** @var IFormatter[] */
    private $formatters = array();

    /** @var ICacheStorage */
    private $cacheStorage;

    /**
     * @param IStorage|NULL $cacheStorage
     *
     * @return void
     */
    public function __construct (ICacheStorage $cacheStorage = null)
    {
        $this->cacheStorage = $cacheStorage ? $cacheStorage : new FileStorage('tmp');
    }

    /**
     * @param Resource $resource
     *
     * @return void
     */
    public function addResource (IFormatter $formatter, IStorage $storage)
    {
        $this->resources[] = new Resource($formatter, $storage);

        if (!in_array($formatter, $this->formatters, true)) {
            $this->formatters[] = $formatter;
        }
    }

    /**
     * @param LangTag     $langtag
     * @param string|NULL $domain
     *
     * @return Catalog
     */
    public function create (LangTag $langtag, $domain = null)
    {
        $cache = new Cache($this->cacheStorage, self::getCacheNamespace($langtag, $domain));

        if (!$cache->load(self::CACHE_KEY_COMPILED) || $cache->load(self::CACHE_KEY_FMTS) !== $this->formatters) {
            $this->makeCache($langtag, $cache);
        }

        return new Catalog($cache);
    }

    /**
     * @param Cache $cache
     *
     * @return void
     */
    private function makeCache (LangTag $langtag, Cache $cache)
    {
        if (empty($this->resources)) {
            $this->makeDefaultResource();
        }

        $cache->clean();
        $files = array();
        $cache->save(self::CACHE_KEY_FMTS, $this->formatters);

        foreach ($this->resources as $resource) {
            $fmt = array_search($resource->getFormatter(), $this->formatters, true);
            foreach ($resource->getAllMessages($langtag) as $msgid => $msg) {
                $cache->save($msgid, self::makeMessage($msg, $fmt));
            }
            $files[] = $resource->getFile();
        }

        $cache->save(self::CACHE_KEY_COMPILED, true, array(Cache::FILES => $files));
    }

    /**
     * @return Resource Using MessageFormatter and NeonStorage
     */
    private function makeDefaultResource ()
    {
        $this->addResource(new NeonStorage(), new MessageFormatter());
    }

    /**
     * @param string $message
     * @param int    $formatter
     *
     * @return array [string => string]
     */
    private static function makeMessage ($message, $formatter)
    {
        return array('msg' => $message, 'fmt' => $formatter);
    }

    /**
     * @param Lukaj\Uniloc\LangTag $langtag
     * @param string|NULL          $domain
     *
     * @return string
     */
    protected static function getCacheNamespace (LangTag $langtag, $domain = null)
    {
        return "{self::CACHE_NAMESPACE}.{$langtag->getTag()}.{$domain}";
    }
}