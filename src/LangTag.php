<?php

namespace Lukaj\Uniloc;

use LogicException;
use Lukaj\Uniloc\LangTagParser;

/**
 * @author Lukas Mazur
 */
class LangTag
{
    /**@var string */
    const SEPARATOR = '-';

    /** @var string[] */
    private $subtags;

    /**
     * @param string $locale Valid locale identifier (only self::SEPARATOR is supported as a separator)
     *
     * @throws LogicException if locale is invalid
     */

    public function __construct ($tag)
    {
        if (($this->subtags = LangTagParser::parse($tag, self::SEPARATOR)) === null) {
            throw new LogicException("String {$tag} is not valid language tag.");
        }
    }

    /**
     * @return string
     */
    public function getTag ()
    {
        return implode($this->subtags, self::SEPARATOR);
    }

    /**
     * @return string
     */
    public function getLanguage ()
    {
        return $this->subtags['language'];
    }

    /**
     * @return string
     */
    public function getScript ()
    {
        return isset($this->subtags['script']) ? $this->subtags['script'] : '';
    }

    /**
     * @return string
     */
    public function getRegion ()
    {
        return isset($this->subtags['region']) ? $this->subtags['region'] : '';
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->getTag();
    }

    /**
     * @return static|NULL Returns NULL if no other fallback exists
     */
    public function getNextFallback ()
    {
        if (count($this->subtags) === 1) {
            return null;
        }

        $fallback = clone $this;
        array_pop($fallback->subtags);

        return $fallback;
    }

    /**
     * @param self|string $langtag
     *
     * @return self
     *
     * @throws LogicException if locale is invalid
     */
    public function from ($langtag)
    {
        if ($langtag instanceof self) {
            return $langtag;
        }

        try {
            return new self($langtag);
        } catch (LogicException $e) {
            throw new LogicException($e->getMessage());
        }
    }

    /**
     * Convenience function if you want to use *non-standard* separator (other than hyphen)
     *
     * @param string $tag
     * @param string $newSeparator
     *
     * @return string
     */
    public static function replaceSeparator ($tag, $newSeparator = self::SEPARATOR)
    {
        return preg_replace('#[^[:alpha:]]#', $newSeparator, $tag);
    }
}