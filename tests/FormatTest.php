<?php namespace Valorin\TimeParser\Test;

use Carbon\Carbon;
use Valorin\TimeParser\TimeParser;

class FormatTest extends \PHPUnit_Framework_TestCase
{
    public function testFormat12()
    {
        $format = TimeParser::FORMAT12;
        TimeParser::setFormat($format);
        $expected = Carbon::now()->hour(11)->minute(22)->second(33)->format($format);

        $actual   = TimeParser::parse("11:22:33");
        $this->assertEquals($expected, $actual);
    }

    public function testFormat12Seconds()
    {
        $format = TimeParser::FORMAT12SEC;
        TimeParser::setFormat($format);
        $expected = Carbon::now()->hour(11)->minute(22)->second(33)->format($format);

        $actual   = TimeParser::parse("11:22:33");
        $this->assertEquals($expected, $actual);
    }

    public function testFormat24Seconds()
    {
        $format = TimeParser::FORMAT24SEC;
        TimeParser::setFormat($format);
        $expected = Carbon::now()->hour(11)->minute(22)->second(33)->format($format);

        $actual   = TimeParser::parse("11:22:33");
        $this->assertEquals($expected, $actual);
    }


    public function testFormat24()
    {
        $format = TimeParser::FORMAT24;
        TimeParser::setFormat($format);
        $expected = Carbon::now()->hour(11)->minute(22)->second(33)->format($format);

        $actual   = TimeParser::parse("11:22:33");
        $this->assertEquals($expected, $actual);
    }
}
