<?php

namespace Lukaj\Uniloc;

if (extension_loaded('intl')) {
    class_alias('Locale', 'Lukaj\Intl\Locale');
    return;
}

/**
 * @internal
 */
class Locale
{
    /** @var string */
    private static $defaultLocale = 'en-US';

    /**
     * @throws LogicException if invoked
     */
    public function acceptFromHttp ($header)
    {
        throw LogicException('For using this method please install intl extension');
    }

    /**
     * @throws LogicException if invoked
     */
    public function canonicalize ($locale)
    {
        throw LogicException('For using this method please install intl extension');
    }

    /**
     * @param array $subtags
     * @return string All unrecognized keys are considered as variant
     */
    public function composeLocale (array $subtags)
    {
        $loc = isset($subtags['language']) ? strtolower($subtags['language']) : '';
        $loc .= isset($subtags['script']) ? (empty($loc) ? '' : $separator) . ucfirst($subtags['script']) : '';
        $loc .= isset($subtags['region']) ? (empty($loc) ? '' : $separator) . strtoupper($subtags['region']) : '';

        unset($subtags['language'], $subtags['script'], $subtags['region']);
        ksort($subtags);
        foreach ($subtags as $val) {
            $loc .= (empty($loc) ? '' : $separator) . strtoupper($val);
        }
    }

    /**
     * @throws LogicException if invoked
     */
    public function filterMatches ($langtag, $locale, $canonicalize = false)
    {
        throw LogicException('For using this method please install intl extension');
    }

    /**
     * @throws LogicException if invoked
     */
    public function getAllVariants ($locale)
    {
        throw LogicException('For using this method please install intl extension');
    }

    /**
     * @throws LogicException if invoked
     */
    public function getDefault ()
    {
        return self::$defaultLocale;
    }

    /**
     * @throws LogicException if invoked
     */
    public function getDisplayLanguage ($locale, $in_locale = null)
    {
        throw LogicException('For using this method please install intl extension');
    }

    /**
     * @throws LogicException if invoked
     */
    public function getDisplayName ($locale, $in_locale = null)
    {
        throw LogicException('For using this method please install intl extension');
    }

    /**
     * @throws LogicException if invoked
     */
    public function getDisplayRegion ($locale, $in_locale = null)
    {
        throw LogicException('For using this method please install intl extension');
    }

    /**
     * @throws LogicException if invoked
     */
    public function getDisplayScript ($locale, $in_locale = null)
    {
        throw LogicException('For using this method please install intl extension');
    }

    /**
     * @throws LogicException if invoked
     */
    public function getDisplayVariant ($locale, $in_locale = null)
    {
        throw LogicException('For using this method please install intl extension');
    }

    /**
     * @throws LogicException if invoked
     */
    public function getKeywords ($locale)
    {
        throw LogicException('For using this method please install intl extension');
    }

    /**
     * @throws LogicException if invoked
     */
    public function getPrimaryLanguage ($locale)
    {
        throw LogicException('For using this method please install intl extension');
    }

    /**
     * @throws LogicException if invoked
     */
    public function getRegion($locale)
    {
        throw LogicException('For using this method please install intl extension');
    }

    /**
     * @throws LogicException if invoked
     */
    public function getScript ($locale)
    {
        throw LogicException('For using this method please install intl extension');
    }

    /**
     * @throws LogicException if invoked
     */
    public function lookup (array $langtag, $locale, $canonicalize = false, $default = null)
    {
        throw LogicException('For using this method please install intl extension');
    }

    /**
     * @throws LogicException if invoked
     */
    public function parseLocale ($locale)
    {
        throw LogicException('For using this method please install intl extension');
    }

    /**
     * @param strign $locale
     */
    public function setDefault ($locale)
    {
        self::$defaultLocale = $locale;
    }
}
