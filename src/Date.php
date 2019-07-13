<?php namespace Framework\Date;

/**
 * Class Date.
 *
 * @see     https://www.php.net/manual/en/intldateformatter.format.php#106070
 * @see     https://www.php.net/manual/en/intldateformatter.format.php#refsect1-intldateformatter.format-changelog
 * @see     https://www.php.net/manual/en/function.strftime.php
 */
class Date extends \DateTime implements \JsonSerializable
{
	public const MYSQL = 'Y-m-d H:i:s';
	public const COOKIE = 'l, d-M-Y H:i:s T';

	public function __toString()
	{
		return $this->format(static::ATOM);
	}

	public function jsonSerialize()
	{
		return $this->format(static::ATOM);
	}

	/**
	 * @param string             $format
	 * @param string             $time
	 * @param \DateTimeZone|null $timezone
	 *
	 * @return Date|false
	 */
	public static function createFromFormat($format, $time, \DateTimeZone $timezone = null)
	{
		$object = parent::createFromFormat($format, $time, $timezone);
		return $object ? new static($object->format(static::ATOM)) : $object;
	}
}
