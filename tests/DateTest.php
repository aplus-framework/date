<?php
/*
 * This file is part of Aplus Framework Date Library.
 *
 * (c) Natan Felles <natanfelles@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Tests\Date;

use Framework\Date\Date;
use Framework\Language\Language;
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

    /**
     * @return array<array<string>>
     */
    public function humanizeProvider() : array
    {
        return [
            ['now', 'just now'],
            ['-1 seconds', '1 second ago'],
            ['+1 seconds', 'in 1 second'],
            ['-3 seconds', '3 seconds ago'],
            ['+3 seconds', 'in 3 seconds'],
            ['-1 minutes', '1 minute ago'],
            ['+1 minutes', 'in 1 minute'],
            ['-3 minutes', '3 minutes ago'],
            ['+3 minutes', 'in 3 minutes'],
            ['-1 hours', '1 hour ago'],
            ['+1 hours', 'in 1 hour'],
            ['-3 hours', '3 hours ago'],
            ['+3 hours', 'in 3 hours'],
            ['-1 days', '1 day ago'],
            ['+1 days', 'in 1 day'],
            ['-3 days', '3 days ago'],
            ['+3 days', 'in 3 days'],
            ['-1 weeks', '1 week ago'],
            ['+1 weeks', 'in 1 week'],
            ['-3 weeks', '3 weeks ago'],
            ['+3 weeks', 'in 3 weeks'],
            ['-2 months', '2 months ago'],
            ['+2 months', 'in 2 months'],
            ['-3 months', '3 months ago'],
            ['+3 months', 'in 3 months'],
            ['-1 years', '1 year ago'],
            ['+1 years', 'in 1 year'],
            ['-3 years', '3 years ago'],
            ['+3 years', 'in 3 years'],
        ];
    }

    /**
     * @dataProvider humanizeProvider
     *
     * @param string $datetime
     * @param string $text
     */
    public function testHumanize(string $datetime, string $text) : void
    {
        $date = new Date($datetime);
        self::assertSame($text, $date->humanize());
    }

    public function testHumanizeLocalized() : void
    {
        $date = new Date('+10 minutes', language: new Language('pt-br'));
        self::assertSame('em 10 minutos', $date->humanize());
    }
}
