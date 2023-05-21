<?php

namespace StyleShit\Zod;

use StyleShit\Zod\Schemas\NumberSchema;
use StyleShit\Zod\Schemas\ObjectSchema;
use StyleShit\Zod\Schemas\StringSchema;

class Zod
{
    public static function object($schema = [])
    {
        return ObjectSchema::make($schema);
    }

    public static function string()
    {
        return StringSchema::make();
    }

    public static function number()
    {
        return NumberSchema::make();
    }
}
