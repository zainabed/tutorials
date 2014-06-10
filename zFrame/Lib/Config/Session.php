<?php

namespace Lib\Config;

class Session {

    protected static $session_array = null;

    public static function enableSeesion() {
        if (self::$session_array == null) {
            self::$session_array = array();
        }
    }

    /**
     * 
     * @param String $key
     * @return Mix
     */
    public static function getValue($key) {
        self::enableSeesion();
        if (isset(self::$session_array[$key])) {
            return self::$session_array[$key];
        } else {
            //throw exception
        }
    }

    /**
     * 
     * @param String $key
     * @param Mix $value
     */
    public static function setValue($key, $value) {
        self::enableSeesion();
        self::$session_array[$key] = $value;
    }

}