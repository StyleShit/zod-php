<?php

namespace StyleShit\Zod\Schemas;

use StyleShit\Zod\Contracts\Schema;
use StyleShit\Zod\Exceptions\InvalidStringException;
use StyleShit\Zod\Exceptions\LongStringException;
use StyleShit\Zod\Exceptions\ShortStringException;

class StringSchema implements Schema
{
    private $min;

    private $max;

    public static function make()
    {
        return new static();
    }

    public function min($min)
    {
        $this->min = $min;

        return $this;
    }

    public function max($max)
    {
        $this->max = $max;

        return $this;
    }

    public function parse($value)
    {
        if (! is_string($value)) {
            throw InvalidStringException::make($value);
        }

        if (! is_null($this->min) && strlen($value) < $this->min) {
            throw ShortStringException::make($value, $this->min);
        }

        if (! is_null($this->max) && strlen($value) > $this->max) {
            throw LongStringException::make($value, $this->max);
        }

        return $value;
    }
}
