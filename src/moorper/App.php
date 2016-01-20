<?php
namespace moorper;

use moorper\Config;
use moorper\Request;
use \Exception;

/**
 *
 */
class App
{
    private $base_path = '';
    public function __construct($base_path = null)
    {
        if (is_null($base_path)) {
            throw new Exception("Error Processing Request", 1);
        }
        if (is_dir($base_path)) {
            throw new Exception("Error Processing Request", 1);
        }
        $this->base_path = $base_path;
        //$this->init();
    }
    private function init()
    {
        defined('BASE_PATH') or define('BASE_PATH', $base_path);
        defined('FRAMEWORK_CONFIG_PATH') or define('FRAMEWORK_CONFIG_PATH', BASE_PATH . '/config');
        $this->initConfig();
        // 注册错误弹出页面
        \moorper\Error::init();
        // 加载配置
        \moorper\Config::init();
        // 注册日志
        \moorper\Log::init();
        // 注册数据库
        \moorper\Database::init();
    }
    private function initConfig()
    {
        Config::load('config', FRAMEWORK_CONFIG_PATH);
        Config::load('database', FRAMEWORK_CONFIG_PATH);
    }
    public function config($config)
    {
        $path = FRAMEWORK_CONFIG_PATH . $config . '.php';
        Config::load($config, $path);
    }
    public function run()
    {
        $request = new Request();
        // 加载路由文件
        require __DIR__ . '/../config/route.php';
        //
        $httpMethod = $_SERVER['REQUEST_METHOD'];
        $uri        = rawurldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
        $routeInfo  = $dispatcher->dispatch($httpMethod, $uri);
        switch ($routeInfo[0]) {
            case FastRoute\Dispatcher::NOT_FOUND:
                echo 'not FOUND';
                break;
            case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
                $allowedMethods = $routeInfo[1];
                // ... 405 Method Not Allowed
                break;
            case FastRoute\Dispatcher::FOUND:
                $handler = $routeInfo[1];
                $vars    = $routeInfo[2];

                $handler = trim($handler);
                $handler = explode('@', $handler);

                $className = 'application\\controller\\' . $handler[0];
                $class     = new $className();
                $data      = $class->$handler[1]();
                echo $data;
                break;
        }
    }
}
