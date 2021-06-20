<?php namespace Framework\Date;

use DateTime;
use DateTimeImmutable;
use DateTimeZone;
use JsonSerializable;

/**
 * Class Date.
 *
 * @see https://www.php.net/manual/en/intldateformatter.format.php#106070
 * @see https://www.php.net/manual/en/intldateformatter.format.php#refsect1-intldateformatter.format-changelog
 * @see https://www.php.net/manual/en/function.strftime.php
 */
class Date extends DateTime implements JsonSerializable
{
	public const DATETIME = 'Y-m-d H:i:s';

	public function __toString()
	{
		return $this->format(static::ATOM);
	}

	public function jsonSerialize()
	{
		return $this->format(static::ATOM);
	}

	/**
	 * Parse a string into a new Date object according to the specified format.
	 *
	 * @param string $format Format accepted by date()
	 * @param string $time A string representing the time
	 * @param DateTimeZone|null $timezone A DateTimeZone object representing the desired time zone
	 *
	 * @return Date|false
	 */
	public static function createFromFormat($format, $time, DateTimeZone $timezone = null)
	{
		$object = parent::createFromFormat($format, $time, $timezone);
		return $object ? new static($object->format(static::ATOM)) : $object;
	}

	/**
	 * @param DateTimeImmutable $datetTimeImmutable
	 *
	 * @return Date
	 */
	public static function createFromImmutable($datetTimeImmutable)
	{
		$object = parent::createFromImmutable($datetTimeImmutable);
		return $object ? new static($object->format(static::ATOM)) : $object;
	}
}
