<?php

namespace Lukaj\Uniloc\Locale;

use LogicException;
use Lukaj\Uniloc\LangTag;
use Lukaj\Uniloc\Locale\ILocale;

/**
 * @author Lukas Mazur
 */
class LocaleFactory
{
	/** @var ILocale[] */
	private static $locales = array();

	/**
	 * Static class
	 *
	 * @throws LogicException if invoked
	 */
	public function __construct ()
	{
		throw LogicException('Class ' . __CLASS__ . 'is static only.');
	}

	/**
	 * Returns ILocale with applying all possible fallbacks.
	 *
	 * @param  LangTag $langtag
	 * @return ILocale
	 *
	 * @throws LogicException if locale not found after aplying all possible fallbacks
	 */
	public static function create (LangTag $langtag)
	{
		if (isset(self::$locales[$langtag])) {
			return self::$locales[$langtag];
		}

		$origLangTag = $langtag->getLangTag();

		do {
			$classname = LangTag::replaceSeparator($langtag->getLangTag(), '_');
			if (class_exists($classname)) {
				return $locales[$origLangTag] = new $classname;
			}
		} while ($langtag = $langtag->getNextFallback());

		throw LogicException("Locale for {$origLangTag} and its fallbacks not found.");
	}
}