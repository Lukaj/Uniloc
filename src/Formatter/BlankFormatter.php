<?php

namespace Lukaj\Uniloc\Formatter;

use Lukaj\Uniloc\Formatter\IFormatter;
use Lukaj\Uniloc\LangTag;

/**
 * @author Lukas Mazur
 */
class BlankFormatter implements IFormatter
{
    /**
     * {@inheritDoc}
     */
    public function setLocale(LangTag $locale)
    {
    }

    /**
     * {@inheritDoc}
     */
    public function format($message, array $args = null)
    {
        return $message;
    }
}