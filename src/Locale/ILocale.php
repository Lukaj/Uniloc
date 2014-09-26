<?php

namespace Lukaj\Uniloc\Locale;

/**
 * @author Lukas Mazur
 */
interface ILocale
{
    /**
     * Returns one of Unicode CLDR plural categories
     *
     * @param int|float $count If float a rule for fraction is returned.
     *
     * @return string
     */
    static function getPlural ($count);
}