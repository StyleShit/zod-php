<?php

namespace StyleShit\Zod\Exceptions;

class ShortStringException extends \Exception
{
    public static function make($value, $expected)
    {
        return new static('String is too short. Expected a string with at least '.$expected.' characters, `'.strlen($value).'` given.');
    }
}
