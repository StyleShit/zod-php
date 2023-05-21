<?php

namespace StyleShit\Zod\Schemas;

abstract class Schema
{
    protected $isOptional = false;

    protected $defaultValue = null;

    public function optional()
    {
        $this->isOptional = true;

        return $this;
    }

    public function required()
    {
        $this->isOptional = false;

        return $this;
    }

    public function default($value)
    {
        // Parse the default value to make sure it's valid for the current schema.
        $this->defaultValue = $this->parseValue($value);

        return $this->optional();
    }

    public function parse($value = null)
    {
        if ($this->isOptional && is_null($value)) {
            return $this->defaultValue;
        }

        return $this->parseValue($value);
    }

    abstract protected function parseValue($value);
}
