<?php
/*
 * This file is part of The Framework Date Library.
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

	final public function __construct(string $datetime = 'now', DateTimeZone $timezone = null)
	{
		parent::__construct($datetime, $timezone);
	}

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
	 * @throws Exception Emits Exception in case of an error
	 *
	 * @return false|static
	 */
	public static function createFromFormat($format, $time, DateTimeZone $timezone = null)
	{
		$object = parent::createFromFormat($format, $time, $timezone);
		return $object ? new static($object->format(static::ATOM)) : $object;
	}

	/**
	 * @param DateTimeImmutable $datetTimeImmutable
	 *
	 * @throws Exception Emits Exception in case of an error
	 *
	 * @return static
	 */
	public static function createFromImmutable($datetTimeImmutable)
	{
		$object = parent::createFromImmutable($datetTimeImmutable);
		return new static($object->format(static::ATOM));
	}
}
