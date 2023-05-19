<?php

namespace StyleShit\Zod\Tests\Parsers;

use StyleShit\Zod\Exceptions\InvalidObjectException;
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
    // Act.
    $result = Z::object()->parse([
        'name' => 'John Doe',
        'age' => 42,
        'address' => [
            'city' => 'Test City',
            'street' => 'Test Street',
        ],
    ]);

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

it('should throw for non-objects', function () {
    // Act & Assert.
    expect(function () {
        Z::object()->parse('test');
    })->toThrow(InvalidObjectException::class);
});
