<?php

namespace Lukaj\Uniloc\Storage;

use Lukaj\Uniloc\LangTag;

/**
 * @author Lukas Mazur
 */
interface IStorage
{
	/*
	 * @param Lukaj\Uniloc\LangTag $langtag
	 * @param string|NULL          $domain
	 *
	 * @return array Array is int the form [msgid => msg] where both key and value are strings. Returns NULL if file not found
	 */
	function load(LangTag $langtag, $domain = NULL);
}
