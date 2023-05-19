<?php

namespace StyleShit\Zod\Parsers;

use StyleShit\Zod\Contracts\Parser;
use StyleShit\Zod\Exceptions\InvalidObjectException;

class ObjectParser implements Parser
{
    /**
     * @var Parser[]|null
     */
    private $schema;

    public function __construct($schema = null)
    {
        $this->schema = $schema;
    }

    public static function make($schema = null)
    {
        return new static($schema);
    }

    public function parse($value)
    {
        if ($this->isAssociativeArray($value)) {
            $value = $this->arrayToObject($value);
        }

        if (! is_object($value)) {
            throw InvalidObjectException::make($value);
        }

        if (is_null($this->schema)) {
            return $value;
        }

        $parsedValue = new \stdClass();

        foreach ($this->schema as $key => $parser) {
            $parsedValue->$key = $parser->parse($value->$key);
        }

        return $parsedValue;
    }

    private function isAssociativeArray($value)
    {
        if (! is_array($value)) {
            return false;
        }

        $keys = array_keys($value);
        $numericKeys = array_filter($keys, 'is_numeric');

        return count($numericKeys) === 0;
    }

    private function arrayToObject($value)
    {
        if (! is_array($value)) {
            return $value;
        }

        foreach ($value as $key => $item) {
            $value[$key] = $this->arrayToObject($item);
        }

        return (object) $value;
    }
}
