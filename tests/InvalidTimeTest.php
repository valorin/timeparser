<?php namespace Valorin\TimeParser\Test;

use Carbon\Carbon;
use Valorin\TimeParser\TimeParser;

class InvalidTimeTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @expectedException Valorin\TimeParser\TimeParserException
     */
    public function testNoNumbers()
    {
        TimeParser::parse("am");
    }

    /**
     * @expectedException Valorin\TimeParser\TimeParserException
     */
    public function testNothing()
    {
        TimeParser::parse("");
    }

    /**
     * @expectedException Valorin\TimeParser\TimeParserException
     */
    public function testNotATime()
    {
        TimeParser::parse("not a time");
    }

    /**
     * @expectedException Valorin\TimeParser\TimeParserException
     */
    public function testInvalidAM()
    {
        TimeParser::parse("13:00 AM");
    }

    /**
     * @expectedException Valorin\TimeParser\TimeParserException
     */
    public function testPmFirst()
    {
        TimeParser::parse("pm 10:23");
    }

    /**
     * @expectedException Valorin\TimeParser\TimeParserException
     */
    public function testFourNumbers()
    {
        TimeParser::parse("1:2:3:4");
    }

    /**
     * @expectedException Valorin\TimeParser\TimeParserException
     */
    public function testTooHighHours()
    {
        TimeParser::parse("27:29");
    }

    /**
     * @expectedException Valorin\TimeParser\TimeParserException
     */
    public function testTooHighMinutes()
    {
        TimeParser::parse("12:69");
    }
}
