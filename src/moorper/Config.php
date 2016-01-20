<?php
namespace moorper;

use Exception;

/**
 *
 */
class Config
{
    static $config = [];

    public static function init()
    {
        $path = dirname(APP_PATH) . '/config/config.php';
        if (file_exists($path)) {
            self::parse('config', $path);
        } else {
            throw new Exception($path . "配置文件不存在", 1);
        }
        $extra = self::get('config')['extra'];
        if (is_array($extra) && !empty($extra)) {
            foreach ($extra as $key => $value) {
                self::load($value);
            }
        }
    }
    public static function get($key)
    {
        return isset(self::$config[$key]) ? self::$config[$key] : null;
    }
    public static function load($name = '', $path = FRAMEWORK_CONFIG_PATH)
    {
        $file = $path . '/' . $name . '.php';
        if (!is_file($file)) {
            throw new Exception($path . "配置文件不存在", 1);
        }
        $config = include $file;
        if (!is_array($config)) {
            throw new Exception($file . "配置文件必须是数组", 1);
        }
        self::set($name, $config);
        return self::$config[$name];
    }
    public static function set($key, $value)
    {
        self::$config[$key] = $value;
    }
    // public static function parse($source)
    // {
    //     if (is_array($source) && !empty($source)) {
    //         foreach ($source as $key => $value) {
    //             self::set($key, $value);
    //         }
    //     }
    // }
}
