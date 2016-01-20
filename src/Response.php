<?php
namespace moorper;

/**
 *
 */
class Response
{
    private static $types = [
        'json'   => 'application/json',
        'xml'    => 'text/xml',
        'html'   => 'text/html',
        'jsonp'  => 'application/javascript',
        'script' => 'application/javascript',
        'text'   => 'text/plain',
    ];
    private static $httpStatus = [
        // Informational 1xx
        100 => 'Continue',
        101 => 'Switching Protocols',
        // Success 2xx
        200 => 'OK',
        201 => 'Created',
        202 => 'Accepted',
        203 => 'Non-Authoritative Information',
        204 => 'No Content',
        205 => 'Reset Content',
        206 => 'Partial Content',
        // Redirection 3xx
        300 => 'Multiple Choices',
        301 => 'Moved Permanently',
        302 => 'Moved Temporarily ', // 1.1
        303 => 'See Other',
        304 => 'Not Modified',
        305 => 'Use Proxy',
        // 306 is deprecated but reserved
        307 => 'Temporary Redirect',
        // Client Error 4xx
        400 => 'Bad Request',
        401 => 'Unauthorized',
        402 => 'Payment Required',
        403 => 'Forbidden',
        404 => 'Not Found',
        405 => 'Method Not Allowed',
        406 => 'Not Acceptable',
        407 => 'Proxy Authentication Required',
        408 => 'Request Timeout',
        409 => 'Conflict',
        410 => 'Gone',
        411 => 'Length Required',
        412 => 'Precondition Failed',
        413 => 'Request Entity Too Large',
        414 => 'Request-URI Too Long',
        415 => 'Unsupported Media Type',
        416 => 'Requested Range Not Satisfiable',
        417 => 'Expectation Failed',
        // Server Error 5xx
        500 => 'Internal Server Error',
        501 => 'Not Implemented',
        502 => 'Bad Gateway',
        503 => 'Service Unavailable',
        504 => 'Gateway Timeout',
        505 => 'HTTP Version Not Supported',
        509 => 'Bandwidth Limit Exceeded',
    ];
    public static function response($data, $type, $status)
    {
        $type = strtolower($type);
        self::sendHttpStatus($status);
        self::sendHttpContentType($type);
        switch ($type) {
            case 'json':
                $data = json_encode($data);
                break;
            default:
                # code...
                break;
        }
        return $data;
    }
    // 发送Http状态信息
    private static function sendHttpStatus($status)
    {
        if (isset(self::$httpStatus[$status])) {
            header('HTTP/1.1 ' . $status . ' ' . self::$httpStatus[$status]);
            // 确保FastCGI模式下正常
            header('Status:' . $status . ' ' . self::$httpStatus[$status]);
        }
    }
    private static function sendHttpContentType($type)
    {
        if (!headers_sent() && isset(self::$types[$type])) {
            header('Content-Type:' . self::$types[$type] . '; charset=utf-8');
        }
    }

}
