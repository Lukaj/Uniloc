<?php

namespace Lukaj\Uniloc\Storage;

use Lukaj\Uniloc\Storage\IStorage;
use Lukaj\Uniloc\LangTag;
use Lukaj\Uniloc\Helpers;

/**
 * @author Lukas Mazur
 */
class ArrayStorage implements IStorage
{
	/** @var array [string => string] */
	private $arr;

	/**
	 * @param array $arr
	 */
	public function __construct(array $arr)
	{
		$this->arr = $arr;
	}

	/**
	 * {@inheritDoc}
	 */
	public function load(LangTag $langtag, $domain = NULL)
	{
		return Helpers::arrayToDomain($this->arr);
	}
}
