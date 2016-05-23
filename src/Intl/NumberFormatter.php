<?php

namespace Lukaj\Uniloc;

use Locale;
use NumberFormatter as IntlNumberFormatter;

class NumberFormatter extends IntlNumberFormatter
{
    /** @var array */
    private static $formatters;


    /**
     * @param int|null $style
     * @param string|null $pattern
     * @return void
     */
    public function __construct($style = IntlNumberFormatter::DECIMAL, $pattern = null)
    {
        parent::__construct(Locale::getDefault(), $style, $pattern);
    }

    /**
     * @param int|float number
     * @param int|null $style
     * @param string|null $pattern
     * @param int|null $type
     * @return string
     */
    public static function formatNumber($number, $style = IntlNumberFormatter::DECIMAL, $pattern = null, $type = null)
    {
        if (!isset(self::$formatters[$style])) {
            self::$formatters[$style] = new static($style, $pattern);
        }

        self::$formatters[$style]->setPattern($pattern);

        return self::$formatters[$style]->format($number, $type);
    }
}
