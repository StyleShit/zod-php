<?php

namespace StyleShit\Zod\Schemas;

use StyleShit\Zod\Contracts\Schema;
use StyleShit\Zod\Exceptions\BigNumberException;
use StyleShit\Zod\Exceptions\InvalidNumberException;
use StyleShit\Zod\Exceptions\SmallNumberException;

class NumberSchema implements Schema
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
        if (! is_numeric($value)) {
            throw InvalidNumberException::make($value);
        }

        // Convert both integers and floats to numbers.
        $value = $value + 0;

        if (! is_null($this->min) && $value < $this->min) {
            throw SmallNumberException::make($value, $this->min);
        }

        if (! is_null($this->max) && $value > $this->max) {
            throw BigNumberException::make($value, $this->max);
        }

        return $value;
    }
}
