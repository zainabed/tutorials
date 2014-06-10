<?php

namespace Lib\Http;

class Header {

    protected $header_parameters = null;

    public function __construct() {
        ;
    }

    public function __set($name, $value) {
        return $this->header_parameters[$name] = $value;
    }

    public function __get($name) {
        if (isset($this->header_parameters[$name])) {
            return $this->header_parameters[$name];
        } else {
            return null;
        }
    }

    public function __isset($name) {
        return isset($this->header_parameters[$name]);
    }
    
    public function __unset($name) {
        ;
    }

}