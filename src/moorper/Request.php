<?php
namespace moorper;

/**
 *
 */
class Request
{
    private $path    = '';
    private $url     = '';
    private $method  = '';
    private $data    = [];
    private $service = [];
    public function __construct()
    {
        $this->url    = get_url();
        $this->path   = '';
        $this->method = $_SERVER['REQUEST_METHOD'];

        //$uri = rawurldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
    }
    public function url()
    {
        return $this->url;
    }
    public function path()
    {
        return $this->path;
    }
    public function method()
    {
        return $this->method;
    }
    public function get($key = null)
    {

    }
    public function request()
    {
        $request            = [];
        $request['url']     = $this->url;
        $request['path']    = $this->path;
        $request['method']  = $this->method;
        $request['data']    = $this->data;
        $request['service'] = $this->service;
        return $request;
    }
}
