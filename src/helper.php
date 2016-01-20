<?php
if (function_exists('autoload')) {
    function autoload($classname)
    {
        $classname = explode('\\', $classname);
        $classpath = __DIR__ . "/../application/controller/" . $classname[count($classname) - 1] . '.php';
        if (file_exists($classpath)) {
            require_once $classpath;
        } else {
            //throw new Exception("Error Processing Request", 1);
        }
    }
}
if (!function_exists('response')) {
    function response($data, $type = '', $status = 200)
    {
        $data = moorper\Response::response($data, $type, $status);
        return $data;
    }
}
/**
 * 获取当前页面完整URL地址
 */
if (!function_exists('get_url')) {
    function get_url()
    {
        $sys_protocal = isset($_SERVER['SERVER_PORT']) && '443' == $_SERVER['SERVER_PORT'] ? 'https://' : 'http://';
        $php_self     = $_SERVER['PHP_SELF'] ? $_SERVER['PHP_SELF'] : $_SERVER['SCRIPT_NAME'];
        $path_info    = isset($_SERVER['PATH_INFO']) ? $_SERVER['PATH_INFO'] : '';
        $relate_url   = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : $php_self . (isset($_SERVER['QUERY_STRING']) ? '?' . $_SERVER['QUERY_STRING'] : $path_info);
        return $sys_protocal . (isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : '') . $relate_url;
    }
}
