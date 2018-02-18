<?php

namespace RCS;

class JsonException extends \Exception {}

class JsonDecodeException extends \RCS\JsonException {}
class JsonDecodeErrorDepthException extends \RCS\JsonDecodeException {}
class JsonDecodeErrorStateMismatchException extends \RCS\JsonDecodeException {}
class JsonDecodeErrorCtrlCharException extends \RCS\JsonDecodeException {}
class JsonDecodeErrorSyntaxException extends \RCS\JsonDecodeException {}
class JsonDecodeErrorUtf8Exception extends \RCS\JsonDecodeException {}
class JsonDecodeErrorUnknownException extends \RCS\JsonDecodeException {}

class JsonEncodeException extends \RCS\JsonException {}
class JsonEncodeErrorDepthException extends \RCS\JsonEncodeException {}
class JsonEncodeErrorStateMismatchException extends \RCS\JsonEncodeException {}
class JsonEncodeErrorCtrlCharException extends \RCS\JsonEncodeException {}
class JsonEncodeErrorSyntaxException extends \RCS\JsonEncodeException {}
class JsonEncodeErrorUtf8Exception extends \RCS\JsonEncodeException {}
class JsonEncodeErrorUnknownException extends \RCS\JsonEncodeException {}

class Json
{

    public static function Decode($json, $assoc = FALSE, $depth = 512, $options = 0)
    {
        $json_decoded = json_decode($json, $assoc, $depth, $options);

        switch (json_last_error()) {
            case JSON_ERROR_NONE:
                return $json_decoded;
                break;
            case JSON_ERROR_DEPTH:
                throw new \RCS\JsonDecodeErrorDepthException("Maximum stack depth exceeded", 500);
                break;
            case JSON_ERROR_STATE_MISMATCH:
                throw new \RCS\JsonDecodeErrorStateMismatchException("Underflow or the modes mismatch", 500);
                break;
            case JSON_ERROR_CTRL_CHAR:
                throw new \RCS\JsonDecodeErrorCtrlCharException("Unexpected control character found", 500);
                break;
            case JSON_ERROR_SYNTAX:
                throw new \RCS\JsonDecodeErrorSyntaxException("Syntax error, malformed JSON", 500);
                break;
            case JSON_ERROR_UTF8:
                throw new \RCS\JsonDecodeErrorUtf8Exception("Malformed UTF-8 characters, possibly incorrectly encoded", 500);
                break;
            default:
                throw new \RCS\JsonDecodeErrorUnknownException("Unknown error", 500);
                break;
        }
    }

    public static function Encode($value, $options = 0, $depth = 512)
    {
        $json_encoded = json_encode($value, $options, $depth);

        switch (json_last_error()) {
            case JSON_ERROR_NONE:
                return $json_encoded;
                break;
            case JSON_ERROR_DEPTH:
                throw new \RCS\JsonEncodeErrorDepthException("Maximum stack depth exceeded", 500);
                break;
            case JSON_ERROR_STATE_MISMATCH:
                throw new \RCS\JsonEncodeErrorStateMismatchException("Underflow or the modes mismatch", 500);
                break;
            case JSON_ERROR_CTRL_CHAR:
                throw new \RCS\JsonEncodeErrorCtrlCharException("Unexpected control character found", 500);
                break;
            case JSON_ERROR_SYNTAX:
                throw new \RCS\JsonEncodeErrorSyntaxException("Syntax error, malformed JSON", 500);
                break;
            case JSON_ERROR_UTF8:
                throw new \RCS\JsonEncodeErrorUtf8Exception("Malformed UTF-8 characters, possibly incorrectly encoded", 500);
                break;
            default:
                throw new \RCS\JsonEncodeErrorUnknownException("Unknown error", 500);
                break;
        }
    }

}

