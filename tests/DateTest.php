<?php namespace Tests\Date;

use Framework\Date\Date;
use PHPUnit\Framework\TestCase;

final class DateTest extends TestCase
{
	protected Date $date;

	public function setup() : void
	{
		$this->date = new Date();
	}

	public function testCreateFrom() : void
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

	public function testJsonSerialize() : void
	{
		$this->assertEquals(\json_encode(\date(\DATE_ATOM)), \json_encode($this->date));
	}

	public function testToString() : void
	{
		$this->assertEquals(\date(\DATE_ATOM), (string) $this->date);
	}

	public function testConstants() : void
	{
		$this->assertEquals(\date('Y-m-d H:i:s'), $this->date->format($this->date::DATETIME));
	}

	public function testInstance() : void
	{
		$date = new Date();
		$date = $date->setDate(2019, 12, 24);
		$this->assertInstanceOf(Date::class, $date);
		$date = $date->setTime(15, 15);
		$this->assertInstanceOf(Date::class, $date);
	}
}
