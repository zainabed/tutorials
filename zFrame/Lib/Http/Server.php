<?php

namespace Lib\Http;

class Server {

    protected $server_parameters = null;

    public function __construct() {
        $this->server_parameters = $_SERVER;
    }

    public function __set($name, $value) {
        $name = strtoupper($name);
        return $this->server_parameters[$name] = $value;
    }

    public function __get($name) {
        $name = strtoupper($name);
        if (isset($this->server_parameters[$name])) {
            return $this->server_parameters[$name];
        } else {
            return null;
        }
    }

    public function __isset($name) {
        $name = strtoupper($name);
        return isset($this->server_parameters[$name]);
    }

    public function __unset($name) {
        $name = strtoupper($name);
        unset($this->server_parameters[$name]);
    }

}