<?php

namespace Lukaj\Translator;

use Locale;

class NumberFormatter extends \NumberFormatter
{
	/** @var array */
	private static $formatters;
	

	/**
	 * @param int|NULL $style
	 * @param string|NULL $pattern
	 * @return void
	 */
	public function __construct($style = \NumberFormatter::DECIMAL, $pattern = NULL)
	{
		parent::__construct(Locale::getDefault(), $style, $pattern);
	}
	
	/**
	 * @param int|NULL $style
	 * @param string|NULL $pattern
	 * @return Lukaj\Translator\NumberFormatter
	 */
	/*public static function create($style = \NumberFormatter::DECIMAL, $pattern = NULL)
	{
		return new static($style, $pattern);
	}*/
	
	/**
	 * @param int|float number
	 * @param int|NULL $style
	 * @param string|NULL $pattern
	 * @param int|NULL $type
	 * @return string
	 */
	public static function formatNumber($number, $style = \NumberFormatter::DECIMAL, $pattern = NULL, $type = NULL)
	{
		if (!isset(self::$formatters[$style])) {
			self::$formatters[$style] = new static($style, $pattern);
		}
		
		self::$formatters[$style]->setPattern($pattern);
				
		return self::$formatters[$style]->format($number, $type);
	}
}
