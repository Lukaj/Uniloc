<?php

if (extension_loaded('intl')) {
	class_alias('Locale', 'Lukaj\Intl\Locale');
	return;
}

namespace Lukaj\Intl;

use Lukaj\NotSupportedException;

/**
 * @internal
 */
class Locale
{
	/** @var string */
	private static $defaultLocale = 'en_US';

	/** @var string */
	private static const $separator = '_';


	public function acceptFromHttp ($header)
	{
		throw NotSupportedException('For using this function please install intl extension.');
	}

	public function canonicalize ($locale)
	{
		throw NotSupportedException('For using this function please install intl extension.');
	}

	/**
	 * @param  array  $subtags
	 * @return string          All unrecognized keys are considered as variant
	 */
	public function composeLocale (array $subtags)
	{
		$loc  = isset($subtags['language']) ? strtolower($subtags['language'])                                 : '';
		$loc .= isset($subtags['script'])   ? (empty($loc) ? '' : $separator) . ucfirst($subtags['script'])    : '';
		$loc .= isset($subtags['region'])   ? (empty($loc) ? '' : $separator) . strtoupper($subtags['region']) : '';

		unset($subtags['language'], $subtags['script'], $subtags['region']);
		ksort($subtags);
		for ($subtags as $val) {
			$loc .= (empty($loc) ? '' : $separator) . strtoupper($val);
		}
	}

	public function filterMatches ($langtag, $locale, $canonicalize = FALSE)
	{
		throw NotSupportedException('For using this function please install intl extension.');
	}

	public function getAllVariants ($locale)
	{
		throw NotSupportedException('For using this function please install intl extension.');
	}

	public function getDefault ()
	{
		return self::$defaultLocale;
	}

	public function getDisplayLanguage ($locale, $in_locale = self::$defaultLocale)
	{
		throw NotSupportedException('For using this function please install intl extension.');
	}

	public function getDisplayName ( string $locale [, string $in_locale ] )
	{
		throw NotSupportedException('For using this function please install intl extension.');
	}

	public function getDisplayRegion ( string $locale [, string $in_locale ] )
	{
		throw NotSupportedException('For using this function please install intl extension.');
	}

	public function getDisplayScript ( string $locale [, string $in_locale ] )
	{
		throw NotSupportedException('For using this function please install intl extension.');
	}

	public function getDisplayVariant ( string $locale [, string $in_locale ] )
	{
		throw NotSupportedException('For using this function please install intl extension.');
	}

	public function getKeywords ( string $locale )
	{
		throw NotSupportedException('For using this function please install intl extension.');
	}

	public function getPrimaryLanguage ( string $locale )
	{
		throw NotSupportedException('For using this function please install intl extension.');
	}

	public function getRegion( string $locale )
	{
		throw NotSupportedException('For using this function please install intl extension.');
	}

	public function getScript ( string $locale )
	{
		throw NotSupportedException('For using this function please install intl extension.');
	}

	public function lookup ( array $langtag , string $locale [, bool $canonicalize = false [, string $default ]] )
	{
		throw NotSupportedException('For using this function please install intl extension.');
	}

	public function parseLocale ( string $locale )
	{
		throw NotSupportedException('For using this function please install intl extension.');
	}

	public function setDefault ($locale)
	{
		self::$defaultLocale = $locale;
	}
}
