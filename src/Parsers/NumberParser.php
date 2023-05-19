<?php

namespace StyleShit\Zod\Parsers;

use StyleShit\Zod\Contracts\Parser;
use StyleShit\Zod\Exceptions\InvalidNumberException;

class NumberParser implements Parser
{
    public static function make()
    {
        return new static();
    }

    public function parse($value)
    {
        if (! is_numeric($value)) {
            throw InvalidNumberException::make($value);
        }

        // Convert both integers and floats to numbers.
        return $value + 0;
    }
}
