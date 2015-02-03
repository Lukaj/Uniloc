<?php

namespace Lukaj\Uniloc\Plural;

interface IPlural
{
    /**
     * Gets one of Unicode CLDR plural categories (zero, one, two, few, many, other)
     * @param int $count
     * @return string
     */
    function getCategory ($count);

    /**
     * Gets order of category
     * @param  int $count
     * @return int
     */
    function getNum ($count);
}
