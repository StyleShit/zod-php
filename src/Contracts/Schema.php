<?php

namespace StyleShit\Zod\Contracts;

interface Schema
{
    public function parse($value);
}
