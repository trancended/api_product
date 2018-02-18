<?php

namespace Trancended\ApiProduct\Dictionaries;

class Http
{
    const HTTP_OK = 200;
    const HTTP_CREATED = 201;
    const HTTP_BAD_REQUEST = 400;
    const HTTP_UNAUTHORIZED = 401;
    const HTTP_FORBIDDEN = 403;
    const HTTP_NOT_FOUND = 404;
    const HTTP_METHOD_NOT_ALLOWED = 405;
    const HTTP_NOT_ACCEPTABLE = 406;
    const HTTP_UNPROCESSABLE_ENTITY = 422;
    const HTTP_INTERNAL_SERVER_ERROR = 500;
    const HTTP_SERVICE_UNAVAILABLE = 503;

    private static $codes = array(
        100  => 'Continue',
        101  => 'Switching Protocols',
        self::HTTP_OK  => 'OK',
        self::HTTP_CREATED  => 'Created',
        202  => 'Accepted',
        203  => 'Non-Authoritative Information',
        204  => 'No Content',
        205  => 'Reset Content',
        206  => 'Partial Content',
        300  => 'Multiple Choices',
        301  => 'Moved Permanently',
        302  => 'Moved Temporarily',
        303  => 'See Other',
        304  => 'Not Modified',
        305  => 'Use Proxy',
        self::HTTP_BAD_REQUEST  => 'Bad Request',
        self::HTTP_UNAUTHORIZED  => 'Unauthorized',
        402  => 'Payment Required',
        self::HTTP_FORBIDDEN => 'Forbidden',
        self::HTTP_NOT_FOUND  => 'Not Found',
        self::HTTP_METHOD_NOT_ALLOWED  => 'Method Not Allowed',
        self::HTTP_NOT_ACCEPTABLE  => 'Not Acceptable',
        407  => 'Proxy Authentication Required',
        408  => 'Request Time-out',
        409  => 'Conflict',
        410  => 'Gone',
        411  => 'Length Required',
        412  => 'Precondition Failed',
        413  => 'Request Entity Too Large',
        414  => 'Request-URI Too Large',
        415  => 'Unsupported Media Type',
        self::HTTP_UNPROCESSABLE_ENTITY => 'Unprocessable Entity',
        self::HTTP_INTERNAL_SERVER_ERROR  => 'Internal Server Error',
        501  => 'Not Implemented',
        502  => 'Bad Gateway',
        self::HTTP_SERVICE_UNAVAILABLE  => 'Service Unavailable',
        504  => 'Gateway Time-out',
        505  => 'HTTP Version not supported',
    );

    /**
     *
     * @param int $code
     * @return string eg "HTTP/1.0 200: OK";
     */
    public static function getHeader($code)
    {
        return "HTTP/1.0 $code: ".self::$codes[$code];
    }

    /**
     *
     * @param int $code
     * @return string
     */
    public static function getMessage($code)
    {
        return isset(self::$codes[$code]) ? self::$codes[$code] : '';
    }
}
