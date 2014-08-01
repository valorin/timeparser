<?php namespace Valorin\TimeParser;

use Carbon\Carbon;
use Illuminate\Support\Str;

class TimeParser
{
    /**
     * @var string
     */
    const FORMAT24      = 'H:i';
    const FORMAT24SEC   = 'H:i:s';
    const FORMAT12      = 'h:i a';
    const FORMAT12SEC   = 'h:i:s a';
    const REGEX_STRIP   = '/[^0-9apm:.]/i';
    const REGEX_EXPLODE = '/^([012]?[0-9])(?:[:.]?([0-5]\d?))?(?:[:.]?([0-5]\d?))?([ap]m?)?$/i';
    const EXCEPTION     = 'Time provided in unknown format, cannot parse: ';

    /**
     * @var string
     */
    protected static $format = self::FORMAT24;

    /**
     * Set the default format to return times in.
     *
     * @param  string $format
     * @return void
     */
    public static function setFormat($format)
    {
        self::$format = $format;
    }

    /**
     * Parses random human inputted time into the specified format.
     *
     * @param  string $rawTime
     * @return string
     */
    public static function parse($rawTime)
    {
        $parser = new self();
        return $parser->parseRaw($rawTime);
    }

    /**
     * Controls the parsing process
     *
     * @param  string $rawTime
     * @return string
     * @throws TimeParserException
     */
    public function parseRaw($rawTime)
    {
        // Explode into useful components
        $components = $this->explode($rawTime);

        // Attempt to parse simple 12-hour times
        $time = $this->parseTwelveHour($components);

        if ($time) {
            return $time->format(self::$format);
        }


        // Throw exception if we can't parse it.
        throw new TimeParserException(self::EXCEPTION.$rawTime);
    }

    /**
     * Explodes the time string into potential components
     *
     * @param  string $rawTime
     * @return array
     * @throws TimeParserException
     */
    protected function explode($rawTime)
    {
        // Strip weird characters
        $rawTime  = strtolower($rawTime);
        $stripped = preg_replace(self::REGEX_STRIP, '', $rawTime);

        // Magical explode
        if (!preg_match(self::REGEX_EXPLODE, $stripped, $matches)) {
            throw new TimeParserException(self::EXCEPTION.$rawTime);
        }

        // Clean matches
        array_shift($matches);

        if (is_numeric($matches[1]) && strlen($matches[1]) == 1) {
            $matches[1] .= 0;
        }
        if (is_numeric($matches[2]) && strlen($matches[2]) == 1) {
            $matches[2] .= 0;
        }

        return $matches;
    }

    /**
     * Look for, and parse, simple 12-hour time
     *
     * @param  array $components
     * @return Carbon
     */
    protected function parseTwelveHour($components)
    {
        // Check for an am/pm
        if (!Str::startsWith($components[3], ['a', 'p'])) {
            return null;
        }

        // Expecting hours in #0
        if ($this->numericBetween($components[0], 1, 12)) {

            // Increment hours if PM
            if (Str::startsWith($components[3], 'p')) {
                $components[0] += 12;
            }

            // Expecting Minutes in #1
            if ($this->numericBetween($components[1], 0, 59)) {

                // Expecting Seconds in #2
                if ($this->numericBetween($components[2], 0, 59)) {

                    // Full time provided
                    return Carbon::now()->hour($components[0])->minute($components[1])->second($components[2]);
                }

                // Hours and minutes provided
                return Carbon::now()->hour($components[0])->minute($components[1])->second(0);
            }

            // Only hours provided
            return Carbon::now()->hour($components[0])->minute(0)->second(0);
        }

        var_dump($components);
    }

    /**
     * Checks if the value is numeric and betwen the values
     *
     * @param  integer $value
     * @param  integer $min
     * @param  integer $max
     * @return boolean
     */
    protected function numericBetween($value, $min, $max)
    {
        return is_numeric($value) && $value >= $min && $value <= $max;
    }
}
