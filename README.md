TimeParser
==========

Simple PHP class for parsing time values entered by users in a wide range of formats.

Installation
-----------

Add to your `composer.json` file:

```
"valorin/timeparser" : "*"
```

Usage
-----

Add a `use` namespace declaration to your class:

```
use Valorin\TimeParser\TimeParser;
```

Set the required output format, and run the `::parse()` function:

```
TimeParser::setFormat(TimeParser::FORMAT24);
$time = TimeParser::parse("09:32 am");
```
