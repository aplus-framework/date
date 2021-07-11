<?php
/*
 * This file is part of The Framework Date Library.
 *
 * (c) Natan Felles <natanfelles@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Tests\Date;

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
        self::assertInstanceOf(
            Date::class,
            Date::createFromFormat('Y-m-d H:i:s', '2019-07-12 22:46:20')
        );
        self::assertInstanceOf(
            Date::class,
            Date::createFromImmutable(new \DateTimeImmutable())
        );
    }

    public function testJsonSerialize() : void
    {
        self::assertSame(\json_encode(\date(\DATE_ATOM)), \json_encode($this->date));
    }

    public function testToString() : void
    {
        self::assertSame(\date(\DATE_ATOM), (string) $this->date);
    }

    public function testConstants() : void
    {
        self::assertSame(\date('Y-m-d H:i:s'), $this->date->format($this->date::DATETIME));
    }

    public function testInstance() : void
    {
        $date = new Date();
        $date = $date->setDate(2019, 12, 24);
        self::assertInstanceOf(Date::class, $date);
        $date = $date->setTime(15, 15);
        self::assertInstanceOf(Date::class, $date);
    }
}
