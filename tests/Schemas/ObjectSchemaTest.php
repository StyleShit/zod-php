<?php

namespace StyleShit\Zod\Tests\Schemas;

use StyleShit\Zod\Exceptions\InvalidObjectException;
use StyleShit\Zod\Exceptions\InvalidObjectSchemaException;
use StyleShit\Zod\Zod as Z;

it('should parse an object', function () {
    // Arrange.
    $object = (object) [
        'name' => 'John Doe',
        'age' => 42,
        'address' => (object) [
            'city' => 'Test City',
            'street' => 'Test Street',
        ],
    ];

    // Act.
    $result = Z::object([
        'name' => Z::string(),
        'age' => Z::number(),
        'address' => Z::object([
            'city' => Z::string(),
            'street' => Z::string(),
        ]),
    ])->parse($object);

    // Assert.
    expect($result)->toEqual($object);
});

it('should parse an associative array as object', function () {
    $array = [
        'name' => 'John Doe',
        'age' => 42,
        'address' => [
            'city' => 'Test City',
            'street' => 'Test Street',
        ],
    ];

    // Act.
    $result = Z::object([
        'name' => Z::string(),
        'age' => Z::number(),
        'address' => Z::object([
            'city' => Z::string(),
            'street' => Z::string(),
        ]),
    ])->parse($array);

    // Assert.
    expect($result)->toEqual((object) [
        'name' => 'John Doe',
        'age' => 42,
        'address' => (object) [
            'city' => 'Test City',
            'street' => 'Test Street',
        ],
    ]);
});

it('should throw when passing invalid schemas', function () {
    // Act & Assert.
    expect(function () {
        // Non-array schema.
        Z::object('asd');
    })->toThrow(InvalidObjectSchemaException::class);

    expect(function () {
        // Non-associative array.
        Z::object([
            Z::string(),
            Z::number(),
        ]);
    })->toThrow(InvalidObjectSchemaException::class);

    expect(function () {
        // Non-Schema array.
        Z::object([
            'name' => Z::string(),
            'age' => 'non-schema',
        ]);
    })->toThrow(InvalidObjectSchemaException::class);
});

it('should support optional keys', function () {
    // Act.
    $result = Z::object([
        'name' => Z::string()->optional(),
        'age' => Z::number()->optional(),
    ])->parse([]);

    // Assert.
    expect($result)->toEqual((object) [
        'name' => null,
        'age' => null,
    ]);
});

it('should support required keys', function () {
    // Arrange.
    $name = Z::string()->optional();
    $age = Z::number()->optional();

    // Act & Assert.
    expect(function () use ($name, $age) {
        Z::object([
            'name' => $name->required(),
            'age' => $age->required(),
        ])->parse([]);
    })->toThrow(\Exception::class);
});

it('should support default values', function () {
    // Act.
    $result = Z::object([
        'name' => Z::string()->default('John Doe'),
        'age' => Z::number()->default(42),
    ])->parse([]);

    // Assert.
    expect($result)->toEqual((object) [
        'name' => 'John Doe',
        'age' => 42,
    ]);
});

it('should throw when passing invalid default value', function () {
    // Act & Assert.
    expect(function () {
        Z::object()->default('test');
    })->toThrow(InvalidObjectException::class);
});

it('should throw for non-objects', function () {
    // Act & Assert.
    expect(function () {
        Z::object()->parse('test');
    })->toThrow(InvalidObjectException::class);
});
