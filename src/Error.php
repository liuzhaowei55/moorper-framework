<?php
namespace moorper;

class Error
{
    public function init()
    {
        if (APP_DEBUG) {
            // 注册错误页面
            $whoops = new \Whoops\Run;
            $whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
            $whoops->register();
        }
    }
}
