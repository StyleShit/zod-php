<?php

namespace StyleShit\Zod\Schemas;

use StyleShit\Zod\Exceptions\InvalidObjectException;
use StyleShit\Zod\Exceptions\InvalidObjectSchemaException;

class ObjectSchema extends Schema
{
    /**
     * @var Schema[]
     */
    private $schema;

    public function __construct($schema = [])
    {
        if (! $this->isValidSchemasArray($schema)) {
            throw InvalidObjectSchemaException::make($schema);
        }

        $this->schema = $schema;
    }

    public static function make($schema = [])
    {
        return new static($schema);
    }

    protected function parseValue($value)
    {
        if ($this->isAssociativeArray($value)) {
            $value = $this->arrayToObject($value);
        }

        if (! is_object($value)) {
            throw InvalidObjectException::make($value);
        }

        $parsedValue = new \stdClass();

        foreach ($this->schema as $key => $parser) {
            $parsedValue->$key = $parser->parse($value->$key ?? null);
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

    private function isValidSchemasArray($schema)
    {
        if (! $this->isAssociativeArray($schema)) {
            return false;
        }

        foreach ($schema as $item) {
            if (! ($item instanceof Schema)) {
                return false;
            }
        }

        return true;
    }
}
