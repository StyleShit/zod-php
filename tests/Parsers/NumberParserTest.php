<?php

namespace StyleShit\Zod\Tests\Parsers;

use StyleShit\Zod\Exceptions\InvalidNumberException;
use StyleShit\Zod\Zod as Z;

it('should parse numbers', function () {
    // Act & Assert.
    expect(Z::number()->parse(42))->toEqual(42);
    expect(Z::number()->parse(42.5))->toEqual(42.5);
    expect(Z::number()->parse('42'))->toEqual(42);
});

it('should throw for non-numbers', function () {
    // Act & Assert.
    expect(function () {
        Z::number()->parse('test');
    })->toThrow(InvalidNumberException::class);
});
