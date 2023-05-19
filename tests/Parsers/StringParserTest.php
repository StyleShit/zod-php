<?php

namespace StyleShit\Zod\Tests\Parsers;

use StyleShit\Zod\Exceptions\InvalidStringException;
use StyleShit\Zod\Zod as Z;

it('should parse a string', function () {
    // Act.
    $result = Z::string()->parse('test');

    // Assert.
    expect($result)->toEqual('test');
});

it('should throw for non-strings', function () {
    // Act & Assert.
    expect(function () {
        Z::string()->parse([]);
    })->toThrow(InvalidStringException::class);
});
