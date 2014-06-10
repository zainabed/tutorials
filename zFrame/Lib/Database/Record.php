<?php

namespace Lib\Database;

use Lib\Database\DatabaseManager;

class Record implements \ArrayAccess, \Iterator {

    protected $table_name = null;

    /**
     * Get property values
     * @param String $name Property name
     * @return String Property value
     */
    public function getProperty($name) {
        return $this->columns[$name]['value'];
    }

    /**
     * Set property values
     * @param String $name Property name
     * @param String $value Peroperty value
     */
    public function setProperty($name, $value) {

        $this->columns[$name]['value'] = $value;
    }

    /**
     * Build Model Class
     * @param String $class
     */
    public function __construct($class) {
        //set table name
        $this->table_name = explode('\\', $class);
        $this->table_name = $this->table_name[count($this->table_name) - 1];

        $this->table_name[0] = strtolower($this->table_name[0]);
        $this->table_name = preg_replace_callback('/([A-Z])/', function($c) {
                    return '_' . strtolower($c[0]);
                }, $this->table_name);
        $this->table_name = substr($this->table_name, 0, strpos($this->table_name, '_', 1));
        
    }

    /**
     * Execute magic function to set or update model property
     * @param String $method Method Name
     * @param String $arg Arguments
     * @return String IF type is get then return property's value
     */
    public function __call($method, $arg) {
        $prefix = substr($method, 0, 3);
        //check prefix of method
        if ($prefix == 'get' || $prefix == 'set') {
            //get method name
            $method = substr($method, 3, strlen($method) - 3);
            //convert method to property name
            $method[0] = strtolower($method[0]);
            $property = preg_replace_callback('/([A-Z])/', function($c) {
                        return '_' . strtolower($c[0]);
                    }, $method);
            //fetch property values        
            if ($prefix == 'get') {
                return $this->$property;
            } else {
                //set property
                $this->setProperty($property, $arg[0]);
            }
        }
    }

    /**
     * 
     * @param type $offset
     * @return type
     */
    public function offsetExists($offset) {
        return isset($this->column[$offset]);
    }

    /**
     * 
     * @param type $offset
     * @return type
     */
    public function offsetGet($offset) {

        return $this->column[$offset]['value'];
    }

    /**
     * 
     * @param type $offset
     * @param type $value
     */
    public function offsetSet($offset, $value) {
        $this->column[$offset]['value'] = $value;
    }

    /**
     * 
     * @param type $offset
     */
    public function offsetUnset($offset) {
        $this->column[$offset]['value'] = null;
    }

    /**
     * 
     * @param type $offset
     * @return boolean
     */
    public function isPrimary($offset) {
        if (isset($this->column[$offset]['primary'])) {
            return $this->column[$offset]['primary'];
        }
        return false;
    }

    /**
     * 
     * @return type
     */
    public function save() {
        $database_manager = new DatabaseManager();
        $database_manager->bind($this);
        $database_manager->setTable($this->table_name);
        return $database_manager->save();
    }

    /**
     * 
     * @return type
     */
    public function current() {
        return current($this->columns);
    }

    /**
     * 
     * @return type
     */
    public function key() {
        return key($this->columns);
    }

    /**
     * 
     */
    public function next() {
        next($this->columns);
    }

    /**
     * 
     */
    public function rewind() {
        reset($this->columns);
    }

    /**
     * 
     * @return boolean
     */
    public function valid() {
        $key = key($this->columns);
        if ($key !== NULL && $key !== FALSE) {
            return true;
        }
        return false;
    }

}