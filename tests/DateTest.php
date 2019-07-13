<?php namespace Tests\Date;

use Framework\Date\Date;
use PHPUnit\Framework\TestCase;

class DateTest extends TestCase
{
	/**
	 * @var Date
	 */
	protected $date;

	public function setup() : void
	{
		$this->date = new Date();
	}

	public function testCreateFromFormat()
	{
		$this->assertInstanceOf(
			Date::class,
			Date::createFromFormat('Y-m-d H:i:s', '2019-07-12 22:46:20')
		);
	}

	public function testJsonSerialize()
	{
		$this->assertEquals(\json_encode(\date(\DATE_ATOM)), \json_encode($this->date));
	}

	public function testToString()
	{
		$this->assertEquals(\date(\DATE_ATOM), (string) $this->date);
	}

	public function testConstants()
	{
		$this->assertEquals(\date('Y-m-d H:i:s'), $this->date->format($this->date::MYSQL));
		$this->assertEquals(\date(\DATE_COOKIE), $this->date->format($this->date::COOKIE));
	}
}
