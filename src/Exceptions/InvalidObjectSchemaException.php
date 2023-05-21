<?php

namespace StyleShit\Zod\Exceptions;

class InvalidObjectSchemaException extends \Exception
{
    public static function make($value)
    {
        return new static('Invalid object schema. Expected an array of Schemas, `'.gettype($value).'` given.');
    }
}
