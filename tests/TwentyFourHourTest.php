<?php namespace Valorin\TimeParser\Test;

use Carbon\Carbon;
use Valorin\TimeParser\TimeParser;

class TwentyFourHourTest extends \PHPUnit_Framework_TestCase
{
    public function testSimple()
    {
        $format = TimeParser::FORMAT12;
        TimeParser::setFormat($format);
        $expected = Carbon::now()->hour(9)->minute(32)->format($format);

        $actual   = TimeParser::parse("09:32");
        $this->assertEquals($expected, $actual);

        $actual   = TimeParser::parse("0932");
        $this->assertEquals($expected, $actual);

        $actual   = TimeParser::parse("932");
        $this->assertEquals($expected, $actual);

        $actual   = TimeParser::parse("9.32");
        $this->assertEquals($expected, $actual);

        $expected = Carbon::now()->hour(9)->minute(30)->format($format);

        $actual   = TimeParser::parse("93");
        $this->assertEquals($expected, $actual);

        $actual   = TimeParser::parse("930");
        $this->assertEquals($expected, $actual);

        $actual   = TimeParser::parse("9:3");
        $this->assertEquals($expected, $actual);
    }

    public function testSimplePM()
    {
        $format = TimeParser::FORMAT12;
        TimeParser::setFormat($format);
        $expected = Carbon::now()->hour(16)->minute(13)->format($format);

        $actual   = TimeParser::parse("1613");
        $this->assertEquals($expected, $actual);

        $actual   = TimeParser::parse("16:13");
        $this->assertEquals($expected, $actual);

        $actual   = TimeParser::parse("16.13");
        $this->assertEquals($expected, $actual);

        $expected = Carbon::now()->hour(16)->minute(0)->format($format);

        $actual   = TimeParser::parse("1600");
        $this->assertEquals($expected, $actual);

        $actual   = TimeParser::parse("16");
        $this->assertEquals($expected, $actual);

        $expected = Carbon::now()->hour(16)->minute(40)->format($format);

        $actual   = TimeParser::parse("164");
        $this->assertEquals($expected, $actual);

        $actual   = TimeParser::parse("16:4");
        $this->assertEquals($expected, $actual);
    }

    public function testSeconds()
    {
        $format = TimeParser::FORMAT12SEC;
        TimeParser::setFormat($format);
        $expected = Carbon::now()->hour(20)->minute(18)->second(16)->format($format);

        $actual   = TimeParser::parse("20:18:16");
        $this->assertEquals($expected, $actual);

        $actual   = TimeParser::parse("20.18.16");
        $this->assertEquals($expected, $actual);

        $actual   = TimeParser::parse("201816");
        $this->assertEquals($expected, $actual);
    }
}
