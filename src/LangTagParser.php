<?php

namespace Lukaj\Uniloc;

use LogicException;
use Lukaj\Uniloc\LangTag;

/**
 * @internal
 *
 * @author Lukas Mazur
 */
class LangTagParser
{
    const ST_LANGUAGE = 1;
    const ST_SCRIPT   = 2;
    const ST_REGION   = 4;
    const ST_VARIANT  = 8;

    /**
     * Static only
     *
     * @throws LogicException if invoked
     */
    public function __construct ()
    {
        throw new LogicException('Class' . __CLASS__ . 'is static only.');
    }

    /**
     * Returned array can contain following keys (language, script, region, variant0, variant1, ...)
     *
     * @param string $tag
     * @param string $separator
     *
     * @return array|NULL Returns NULL if $langtag invalid
     */
    public static function parse ($tag, $separator = '-')
    {
        if (!is_string($tag)) {
            return NULL;
        }

        $subtags = array();
        $state = self::ST_LANGUAGE;
        $variantCount = 0;

        foreach (explode($separator, $tag) as $subtag) {
            switch ($state) {
                case self::ST_LANGUAGE:
                    $valid = self::parseLanguage($subtag, $state);
                    $subtags['language'] = $subtag;
                    break;
                case self::ST_SCRIPT:
                    if ($valid = self::parseScript($subtag, $state)) {
                        $subtags['script'] = $subtag;
                        break;
                    }
                    // break omitted intentionally
                case self::ST_REGION:
                    if ($valid = self::parseRegion($subtag, $state)) {
                        $subtags['region'] = $subtag;
                        break;
                    }
                    // break omitted intentionally
                case self::ST_VARIANT:
                    $valid = self::parseVariant($subtag, $state);
                    $subtags['variant' . $variantCount++] = $subtag;
                    break;
            }
            if (!$valid) {
                return null;
            }
        }

        return $subtags;
    }

    /**
     * @param string $language
     * @param mixed  $state This is set to new state
     *
     * @return bool Returns FALSE if $language has invalid format
     */
    private static function parseLanguage ($language, &$state)
    {
        $state = self::ST_SCRIPT;

        return preg_match('#^[[:lower:]]{2,3}$#', $language) === 1;
    }

    /**
     * @param string $script
     * @param mixed  $state This is set to new state
     *
     * @return bool Returns FALSE if $script has invalid format
     */
    private static function parseScript ($script, &$state)
    {
        $state = self::ST_REGION;

        return preg_match('#^[[:upper:]]{1}[[:lower:]]{3}$#', $script) === 1;
    }

    /**
     * @param string $region
     * @param mixed  $state This is set to new state
     *
     * @return bool Returns FALSE if $region has invalid format
     */
    private static function parseRegion ($region, &$state)
    {
        $state = self::ST_VARIANT;

        return preg_match('#^[[:upper:]]{2}$#', $region) === 1;
    }

    /**
     * @param string $variant
     * @param mixed  $state This is set to new state
     *
     * @return bool Returns FALSE if $variant has invalid format
     */
    private static function parseVariant ($variant, &$state)
    {
        $state = self::ST_VARIANT;

        return preg_match('#^[[:alnum:]]+$#', $variant) === 1;
    }
}