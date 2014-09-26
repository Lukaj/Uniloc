<?php

namespace Lukaj\Translator;

use Nette;

class Calendar // not inherits Nette\Object intentionally
{
	private static $intlCalendar;

	/**
	 * This class is static only.
	 * @return void
	 * @throws Nette\StaticClassException if called
	 */
	public function __construct()
	{
		throw new Nette\StaticClassException('Class ' . __CLASS__ . ' is static only');
	}

	/**
	 * @param string $name
	 * @param array $arguments
	 * @return mixed
	 */
	final public static function __callStatic($name, $arguments)
	{
		if (!self::$intlCalendar) {
			self::$intlCalendar = \IntlCalendar::createInstance();
		}

		return call_user_func_array(array(self::$intlCalendar, $name), $arguments);
	}
}
