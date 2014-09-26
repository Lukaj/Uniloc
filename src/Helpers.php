<?php

namespace Lukaj\Uniloc;

/**
 * @author Lukas Mazur
 */
class Helpers
{
	/**
     * Replaces placeholders in storage filename.
     *     [tag]      => complete language tag (such as en-US or he-IL-Ancient)
     *     [language] => language code
     *     [script]   => script
     *     [region]   => region code
     *     [variants] => all variants
     *     [domain]   => domain
     *
     * @param LangTag $langtag
	 * @param string  $pathMask
	 * @param string  $domain
     *
	 * @return string
	 */
	public static function parseStorageFilename (LangTag $langtag, $pathMask, $domain)
	{
		$placeholders = array('[tag]', '[language]', '[script]', '[region]', '[domain]');
        $replace = array($langtag->getTag(), $langtag->getLanguage(), $langtag->getScript(), $langtag->getRegion(), $domain);

		return str_replace($placeholders, $replace, $pathMask);
	}

    /**
     * @param  array $arr
     *
     * @return array [string => string]
     */
    public static function arrayToDomain (array $arr)
    {
        $result = array();

        foreach ($arr as $key => $value) {
            self::flattenArray($value, $key, $result);
        }

        return $result;
    }

    /**
     * @param array  $arr
     * @param string $resultKey
     * @param array  $result
     *
     * @return void
     */
    private static function flattenArray ($arr, $resultKey, &$result)
    {
        // Implementation of this method could be much better with the yield keyword. Unfornutaly, because of compatibility with PHP < 5.5 it couldn't be used.
        if (is_array($arr)) {
            foreach ($arr as $key => $value) {
                self::flattenArray($value, "{$resultKey}.{$key}", $result);
            }
        } else {
            $result[$resultKey] = $arr;
        }
    }
}
