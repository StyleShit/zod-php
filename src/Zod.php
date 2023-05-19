<?php

namespace StyleShit\Zod;

use StyleShit\Zod\Parsers\NumberParser;
use StyleShit\Zod\Parsers\ObjectParser;
use StyleShit\Zod\Parsers\StringParser;

class Zod
{
    public static function object($schema = null)
    {
        return ObjectParser::make($schema);
    }

    public static function string()
    {
        return StringParser::make();
    }

    public static function number()
    {
        return NumberParser::make();
    }
}
