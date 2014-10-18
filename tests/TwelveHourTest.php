<?php namespace Valorin\TimeParser\Test;

use Carbon\Carbon;
use Valorin\TimeParser\TimeParser;

class TwelveHourTest extends \PHPUnit_Framework_TestCase
{
    public function testSimpleAM()
    {
        $format = TimeParser::FORMAT24;
        TimeParser::setFormat($format);
        $expected = Carbon::now()->hour(9)->minute(32)->format($format);

        $actual   = TimeParser::parse("09:32 am");
        $this->assertEquals($expected, $actual);

        $actual   = TimeParser::parse("09:32 AM");
        $this->assertEquals($expected, $actual);

        $actual   = TimeParser::parse("9:32am");
        $this->assertEquals($expected, $actual);

        $actual   = TimeParser::parse("9:32 a");
        $this->assertEquals($expected, $actual);
    }

    public function testSimplePM()
    {
        $format = TimeParser::FORMAT24;
        TimeParser::setFormat($format);
        $expected = Carbon::now()->hour(17)->minute(32)->format($format);

        $actual   = TimeParser::parse("05:32 pm");
        $this->assertEquals($expected, $actual);

        $actual   = TimeParser::parse("5:32 PM");
        $this->assertEquals($expected, $actual);

        $actual   = TimeParser::parse("05:32pm");
        $this->assertEquals($expected, $actual);

        $actual   = TimeParser::parse("5:32 p");
        $this->assertEquals($expected, $actual);
    }

    public function testHourOnly()
    {
        $format = TimeParser::FORMAT24;
        TimeParser::setFormat($format);
        $expected = Carbon::now()->hour(17)->minute(0)->format($format);

        $actual   = TimeParser::parse("5PM");
        $this->assertEquals($expected, $actual);

        $actual   = TimeParser::parse("5pm");
        $this->assertEquals($expected, $actual);

        $actual   = TimeParser::parse("5:0 pm");
        $this->assertEquals($expected, $actual);

        $actual   = TimeParser::parse("50 pm");
        $this->assertEquals($expected, $actual);

        $actual   = TimeParser::parse("500pm");
        $this->assertEquals($expected, $actual);
    }

    public function testRandomMinutes()
    {
        $format = TimeParser::FORMAT24;
        TimeParser::setFormat($format);
        $expected = Carbon::now()->hour(9)->minute(42)->format($format);

        $actual   = TimeParser::parse("942 am");
        $this->assertEquals($expected, $actual);

        $actual   = TimeParser::parse("9.42AM");
        $this->assertEquals($expected, $actual);

        $actual   = TimeParser::parse("0942 am");
        $this->assertEquals($expected, $actual);
    }

    public function testSeconds()
    {
        $format = TimeParser::FORMAT24SEC;
        TimeParser::setFormat($format);
        $expected = Carbon::now()->hour(11)->minute(13)->second(53)->format($format);

        $actual   = TimeParser::parse("11:13:53 am");
        $this->assertEquals($expected, $actual);

        $actual   = TimeParser::parse("111353 AM");
        $this->assertEquals($expected, $actual);

        $actual   = TimeParser::parse("11.13.53 am");
        $this->assertEquals($expected, $actual);

        $expected = Carbon::now()->hour(4)->minute(40)->second(40)->format($format);

        $actual   = TimeParser::parse("4.4.4 am");
        $this->assertEquals($expected, $actual);
    }

    public function testEnsure12PMisNoon()
    {
        $format = TimeParser::FORMAT24;
        TimeParser::setFormat($format);
        $expected = Carbon::now()->hour(12)->minute(0)->format($format);

        $actual   = TimeParser::parse("12pm");
        $this->assertEquals($expected, $actual);
    }
}
