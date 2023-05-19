<?php

namespace StyleShit\Zod;

use StyleShit\Zod\Parsers\StringParser;

class Zod
{
    public static function string()
    {
        return StringParser::make();
    }
}
