<?php

namespace Lib\View;

class View {

    public static $view = null;
    protected $slot_array = null;

    public function __construct() {
        $this->slot_array = array();
    }

    public static function getView() {
        if (self::$view == null) {
            self::$view = new View();
        }
        return self::$view;
    }

    public function include_template($template_name, $inputs) {
        
    }

    public function beginSlot($slot_name) {
        $this->slot_array[$slot_name] = null;
        ob_start();
    }

    public function endSlot($slot_name) {

        $this->slot_array[$slot_name] = ob_get_clean();
    }

    public function includeSlot($slot_name) {
        if (isset($this->slot_array[$slot_name])) {
            echo $this->slot_array[$slot_name];
        }
    }

}