<?php

namespace Lib\Http;

use Lib\Http\Server;

class Request {
    protected static $parameters = null;
    protected $get_parameters = null;
    protected $post_parameters = null;
    public $http_server = null;

    public function __construct() {
        $this->http_server = new Server();
        $this->get_parameters = $_GET;
        $this->post_parameters = $_POST;
        
    }

    /**
     * Set request parameters
     * @param Array $parameters
     */
    public static function setParameters($parameters) {
        $key = null;
        foreach ($parameters as $index => $param) {
            if ($index % 2 == 0) {
                $key = $param;
            } else {
                $_GET[$key] = $param;
            }
        }
        self::$parameters = $_GET;
    }

    public function __set($name, $value) {
        if ($this->http_server->get('request_method') == 'POST') {
            return $this->post_parameters[$name] = $value;
        } else {
            return $this->get_parameters[$name] = $value;
        }
    }

    public function __get($name) {
        if ($this->http_server->request_method == 'POST') {
            if (isset($this->post_parameters[$name])) {
                return $this->post_parameters[$name];
            } else {
                return null;
            }
        } else {
            if (isset($this->get_parameters[$name])) {
                return $this->get_parameters[$name];
            } else {
                return null;
            }
        }
    }

    public function __isset($name) {
        if ($this->http_server->get('request_method') == 'POST') {
            return isset($this->post_parameters[$name]);
        } else {
            return isset($this->get_parameters[$name]);
        }
    }

    public function __unset($name) {
        ;
    }

}