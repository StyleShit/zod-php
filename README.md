# Zod-PHP

A [Zod](https://github.com/colinhacks/zod)-like implementation in PHP, inspired by [Laravel](https://github.com/laravel/framework/)'s code standards.

## Usage:

The usage is pretty simple & straightforward, and is very similar to the original Zod library:

```php
use StyleShit\Zod\Zod as Z;

// Create the schema.
$schema = Z::object([
    'name' => Z::string()->min(3)->max(15),
    'age' => Z::number()->min(0),
    'address' => Z::object([
        'city' => Z::string(),
        'street' => Z::string(),
    ]),
]);

// Validate the data.
$parsed = $schema->parse([
    'name' => 'John Doe',
    'age' => 20,
    'address' => [
        'city' => 'New York',
        'street' => 'Wall Street',
    ],
]);
```

For more information, see the [tests](tests/Parsers/).
