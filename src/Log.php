<?php
namespace moorper;

use Monolog\ErrorHandler;
use Monolog\Handler\BufferHandler;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class Log
{
    public static function init()
    {
        $logConfig = Config::get('log');
        $logName   = $logConfig['path'] . '/' . date('y_m_d') . '.log';
        $logger    = new Logger('run_logger');
        $stream    = new StreamHandler($logName, Logger::DEBUG);
        $logger->pushHandler(new BufferHandler($stream, 10, Logger::DEBUG, true, true)); //用BufferHandler设置同一请求下日志数达到10条再写一次文件
        ErrorHandler::register($logger);
    }
}
