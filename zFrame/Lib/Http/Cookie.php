<?php

namespace Lib\Http;

class Cookie {

    public function __construct() {
        ;
    }

    public function __set($name, $value_array) {
        setcookie($name, $value_array['value'], $value_array['time']);
    }

    public function __get($name) {
        return $_COOKIE[$name];
    }

    public function __isset($name) {
        return isset($_COOKIE[$name]);
    }

    public function __unset($name) {
        setcookie($name, null);
    }

}