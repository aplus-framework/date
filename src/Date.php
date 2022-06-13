<?php declare(strict_types=1);
/*
 * This file is part of Aplus Framework Date Library.
 *
 * (c) Natan Felles <natanfelles@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Framework\Date;

use DateTime;
use DateTimeImmutable;
use DateTimeZone;
use Exception;
use Framework\Language\Language;
use JsonSerializable;
use Stringable;

/**
 * Class Date.
 *
 * @see https://www.php.net/manual/en/intldateformatter.format.php#106070
 * @see https://www.php.net/manual/en/intldateformatter.format.php#refsect1-intldateformatter.format-changelog
 * @see https://www.php.net/manual/en/function.strftime.php
 *
 * @package date
 */
class Date extends DateTime implements JsonSerializable, Stringable
{
    public const DATETIME = 'Y-m-d H:i:s';
    protected Language $language;

    final public function __construct(
        string $datetime = 'now',
        DateTimeZone $timezone = null,
        Language $language = null
    ) {
        parent::__construct($datetime, $timezone);
        if ($language) {
            $this->setLanguage($language);
        }
    }

    public function __toString() : string
    {
        return $this->format(static::ATOM);
    }

    public function setLanguage(Language $language) : static
    {
        $this->language = $language;
        $this->language->addDirectory(__DIR__ . '/Languages');
        return $this;
    }

    public function getLanguage() : Language
    {
        if ( ! isset($this->language)) {
            $this->setLanguage(new Language());
        }
        return $this->language;
    }

    public function jsonSerialize() : string
    {
        return $this->format(static::ATOM);
    }

    /**
     * Parse a string into a new static object according to the specified format.
     *
     * @param string $format Format accepted by date()
     * @param string $datetime A string representing the time
     * @param DateTimeZone|null $timezone A DateTimeZone object representing the
     * desired time zone
     *
     * @throws Exception Emits Exception in case of an error
     *
     * @return false|static
     */
    public static function createFromFormat(
        $format,
        $datetime,
        DateTimeZone $timezone = null
    ) : static | false {
        $object = parent::createFromFormat($format, $datetime, $timezone);
        return $object ? new static($object->format(static::ATOM)) : $object;
    }

    /**
     * @param DateTimeImmutable $object
     *
     * @throws Exception Emits Exception in case of an error
     *
     * @return static
     */
    public static function createFromImmutable(DateTimeImmutable $object) : static
    {
        $object = parent::createFromImmutable($object);
        return new static($object->format(static::ATOM));
    }
}
