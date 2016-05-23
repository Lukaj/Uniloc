<?php

namespace Lukaj\Uniloc;

use Lukaj\Uniloc\LangTag;
use Lukaj\Uniloc\Catalog;

/**
 * @author Lukas Mazur
 */
class Translator
{
    /** @var string */
    const OUT_OF_DOMAIN = ':';

    /** @var Catalog[] */
    private $catalogs;

    /** @var Catalog[] */
    private $defaultCatalogs;

    /** @var string|NULL */
    private $domain;

    /** @var LangTag */
    private $locale;

    /** @var LangTag */
    private $defaultLocale;


    /**
     * @param Catalog      $catalog
     * @param Catalog|NULL $defaultCatalog
     * @param string|NULL  $domain
     */
    public function __construct ($locale, $defaultLocale = null, $domain = null, CatalogFactory $catalogFactory = null)
    {
        $this->locale = LangTag::from($locale);
        $this->defaultLocale = $defaultLocale ? LangTag::from($defaultLocale) : null;
        $this->domain = $domain;
        $this->catalogFactory = $catalogFactory ? $catalogFactory : new CatalogFactory();
    }

    /**
     * @param string $messageId
     *
     * @return string Returns $messageId if message not found
     *
     * @throws LogicException if $messageId is not a string
     */
    public function translate ($messageId)
    {
        if (!is_string($messageId)) {
            throw new LogicException(__METHOD__ . ' expects string');
        }
        if (empty($messageId)) {
            return '';
        }

        if ($messageId[0] === self::OUT_OF_DOMAIN) {
            $messageId = substr($messageId, 1);
            $domain = strstr($messageId, '.', true);
        } else {
            $domain = $this->domain;
        }

        $msg = $this->getMessage($messageId, $domain);

        return $msg ? $msg['fmt']->format($msg['msg']) : $messageId;
    }

    /**
     * @param string $msgid
     * @param string $domain
     *
     * @return array|NULL ['fmt' => IFormatter, 'msg' => string] or NULL if message not found
     */
    private function getMessage ($msgid, $domain)
    {
        if (!array_key_exists($domain, $this->catalogs)) {
            $this->loadCatalog($domain);
        }

        if (!($msg = $this->catalogs[$domain]->getMessage($msgid))) {
            $msg = $this->defaultLocale ? $this->defaultCatalogs[$domain]->getMessage($msgid) : null;
        }

        return $msg;
    }

    /**
     * @param string $domain
     *
     * @return void
     */
    private function loadCatalog ($domain)
    {
        $this->catalogs[$domain] = $this->catalogFactory->create($this->locale, $domain);
        if ($this->defaultLocale) {
            $this->defaultCatalogs[$domain] = $this->catalogFactory->create($this->defaultLocale, $domain);
        }
    }
}
