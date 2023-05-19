<?php

namespace StyleShit\Zod\Parsers;

use StyleShit\Zod\Contracts\Parser;
use StyleShit\Zod\Exceptions\InvalidStringException;

class StringParser implements Parser
{
    public static function make()
    {
        return new static();
    }

    public function parse($value)
    {
        if (! is_string($value)) {
            throw InvalidStringException::make($value);
        }

        return $value;
    }
}
