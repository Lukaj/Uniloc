<?php

namespace Lukaj\Uniloc\Formatter;

use LogicException;
use MessageFormatter as IntlMessageFormatter;
use Lukaj\Uniloc\Formatter\IFormatter;
use Lukaj\Uniloc\LangTag;

/**
 * @author Lukas Mazur
 */
class MessageFormatter implements IFormatter
{
    /** @var LangTag */
    private $langtag;

    /**
     * @throws LogicException if Intl is not loaded
     */
    public function __construct ()
    {
        if (!extension_loaded('intl')) {
            throw new LogicException('MessageFormatter not supported. Please install PHP extension Intl');
        }
    }

    /**
     * {@inheritDoc}
     */
    public function setLocale(LangTag $langtag)
    {
        $this->langtag = $langtag;
    }

    /**
     * {@inheritDoc}
     */
    public function format($message, array $args = null)
    {
        return IntlMessageFormatter::formatMessage($this->langtag->getTag(), $message, $args);
    }
}

