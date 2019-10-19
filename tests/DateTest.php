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

	public function testCreateFrom()
	{
		$this->assertInstanceOf(
			Date::class,
			Date::createFromFormat('Y-m-d H:i:s', '2019-07-12 22:46:20')
		);
		$this->assertInstanceOf(
			Date::class,
			Date::createFromImmutable(new \DateTimeImmutable())
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
		$this->assertEquals(\date('Y-m-d H:i:s'), $this->date->format($this->date::DATETIME));
	}

	public function testInstance()
	{
		$date = new Date();
		$date = $date->setDate(2019, 12, 24);
		$this->assertInstanceOf(Date::class, $date);
		$date = $date->setTime(15, 15);
		$this->assertInstanceOf(Date::class, $date);
	}
}
