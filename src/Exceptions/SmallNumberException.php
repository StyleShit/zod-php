<?php

namespace StyleShit\Zod\Exceptions;

class SmallNumberException extends \Exception
{
    public static function make($value, $expected)
    {
        return new static('Number is too small. Expected a number greater than '.$expected.', `'.$value.'` given.');
    }
}
