# php-json
Wrapper for PHP's Native JSON encode/decode that provides very specific exceptions and details as to what is wrong with the JSON.

## Install

Install latest version using [composer](https://getcomposer.org/).

```
$ composer require rcs_us/php-json
```

## Why?

Too often, we come across code that looks like:

```php
// Decode JSON
$decoded_json = json_encode($json_to_encode);

// Act on decoded JSON
if ( $decoded_json->some_property == "some_value" ) {

}
```

The problem with this is no validation of the JSON *structure* is done. So if you're working with invalid JSON nothing will work as expected.

This library wraps the native json_encode/json_decode functionality, and additionally calls json_last_error(). If JSON_ERROR_NONE is returned ( see http://php.net/manual/en/function.json-last-error.php ), then the value is returned, otherwise a corresponding Exception is thrown.

Several Exceptions are provided, which allows unlimited flexibility on your interaction with potentially invalid JSON.

To catch an Exception of any kind, catch \RCS\JsonException. For any type of encode related issue use \RCS\JsonEncodeException, for any type of decode related issue use \RCS\JsonDecodeException. 

If you want to only catch a syntax error when decoding, use \RCS\JsonDecodeErrorSyntaxException. A list of all possible Exceptions are provided below. In short, all JSON error codes have their own exception, for both encoding and decoding.

You can very easily store this in a PSR-7 Middleware.


## Details/Usage

```php
string \RCS\Json::Encode ( mixed $value [, int $options = 0 [, int $depth = 512 ]] )
mixed \RCS\Json::Decode ( string $json [, bool $assoc = FALSE [, int $depth = 512 [, int $options = 0 ]]] )
```

Encode example

```php
try {
    $encoded_json = \RCS\Json::Encode($json_to_encode);
} catch ( \RCS\JsonException $e ) {
    // ... Do what you want with the exception
}
```

Decode

```php
try {
    $decoded_json = \RCS\Json::Decode($json_to_decode);
} catch ( \RCS\JsonException $e ) {
    // ... Do what you want with the exception
}

```

Possible Exceptions to catch

1. \RCS\JsonException ( extends \Exception )
2. \RCS\JsonDecodeException ( extends \RCS\JsonException )
3. \RCS\JsonDecodeErrorDepthException ( extends \RCS\JsonDecodeException )
4. \RCS\JsonDecodeErrorStateMismatchException ( extends \RCS\JsonDecodeException )
5. \RCS\JsonDecodeErrorCtrlCharException ( extends \RCS\JsonDecodeException )
6. \RCS\JsonDecodeErrorSyntaxException ( extends \RCS\JsonDecodeException )
7. \RCS\JsonDecodeErrorUtf8Exception ( extends \RCS\JsonDecodeException )
8. \RCS\JsonDecodeErrorUnknownException ( extends \RCS\JsonDecodeException )
9. \RCS\JsonEncodeException ( extends \RCS\JsonException )
10. \RCS\JsonEncodeErrorDepthException ( extends \RCS\JsonEncodeException )
11. \RCS\JsonEncodeErrorStateMismatchException ( extends \RCS\JsonEncodeException )
12. \RCS\JsonEncodeErrorCtrlCharException ( extends \RCS\JsonEncodeException )
13. \RCS\JsonEncodeErrorSyntaxException ( extends \RCS\JsonEncodeException )
14. \RCS\JsonEncodeErrorUtf8Exception ( extends \RCS\JsonEncodeException )
15. \RCS\JsonEncodeErrorUnknownException ( extends \RCS\JsonEncodeException )
