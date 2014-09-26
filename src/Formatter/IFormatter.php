<?php

namespace Lukaj\Uniloc\Formatter;

use Lukaj\Uniloc\LangTag;

/**
 * @author Lukas Mazur
 */
interface IFormatter
{
	/**
	 * @param string $message
	 * @param array  $args
	 *
	 *  @return string
	 */
	function format ($message, array $args = NULL);

	/**
	 * @param LangTag $langtag
	 *
	 * @return void
	 */
	function setLocale (LangTag $langtag);
}
