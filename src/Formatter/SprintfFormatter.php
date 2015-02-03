<?php

namespace Lukaj\Uniloc\Formatter;

use Lukaj\Uniloc\Formatter\IFormatter;
use Lukaj\Uniloc\LangTag;

/**
 * @author Lukas Mazur
 */
class SprintfFormatter implements IFormatter
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
    public function format($message, array $args = NULL)
    {
        return vsprintf($message, $args);
    }
}
