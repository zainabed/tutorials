<?php

namespace Lib\Database;

use Lib\View\Yaml\Yaml;
use Config\AppConfig;

abstract class DatabaseAbstract {

    protected $database;
    protected $host;
    protected $db_name;
    protected $username;
    protected $password;
    protected $table;
    protected $_data;
    protected $pdo_object = null;
    protected $primary_key_value = null;
    protected $primary_key = null;

    /**
     * 
     */
    public function setup() {
        //get database information
        $database_infromation = Yaml::parse(AppConfig::getConfigPath() . '/database.yml');
        //set default properties
        if (isset($database_infromation['default'])) {
            $this->database = $database_infromation['default']['database'];
            $this->host = $database_infromation['default']['host'];
            $this->db_name = $database_infromation['default']['db_name'];
            $this->username = $database_infromation['default']['username'];
            $this->password = $database_infromation['default']['password'];
        } else {
            //throw exception
        }
    }

    /**
     * 
     * @param type $table_name
     */
    public function setTable($table_name) {
        $this->table = $table_name;
    }

    /**
     * 
     */
    public function connect() {
        try {
            $this->pdo_object = new \PDO("$this->database:host=$this->host;dbname=$this->db_name", $this->username, $this->password);
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }

    /**
     * 
     */
    public function save() {
        $this->primary_key_value = false;
        if ($this->primary_key_value) {
            //update
            $this->update();
        } else {
            //insert
            $this->insert();
        }
    }

    /**
     * 
     */
    public function insert() {
        $this->connect();
        try {
            $query = "INSERT INTO $this->table " . $this->getColumns() . " VALUES " . $this->getValues();
            $id = $this->pdo_object->exec($query);
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }

    /**
     * 
     */
    public function update() {
        $this->connect();
        try {
            $query = "UPDATE $this->table SET " . $this->getUpdateValues();
            $this->pdo_object->exec($query);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    /**
     * 
     * @return string
     */
    protected function getUpdateValues() {
        $values = '';
        foreach ($this->_data as $key => $record) {
            $values .= ' ' . $key . ' = ' . $this->getRecordValue($record);
        }
        $values = substr($values, 0, strlen($values) - 1);
        $values .= ' WHERE ' . $this->primary_key . ' = ' . $this->primary_key_value;
        return $values;
    }

    /**
     * 
     * @return string
     */
    protected function getColumns() {

        $columns = '( ';

        foreach ($this->_data as $key => $record) {

            if ($record) {
                $columns .= $key . ',';
            }
        }
        $columns = substr($columns, 0, strlen($columns) - 1);
        $columns .= ' )';

        return $columns;
    }

    /**
     * 
     * @return string
     */
    protected function getValues() {

        $values = '( ';
        foreach ($this->_data as $key => $record) {

            if ($record['value']) {
                switch ($record['type']) {
                    case 'int':
                        $values .= $record['value'] . ',';
                        break;
                    default:
                        $values .= "'" . $record['value'] . "'" . ',';
                }
            }
        }
        $values = substr($values, 0, strlen($values) - 1);
        $values .= ' )';
        return $values;
    }

    /**
     * 
     * @param type $record
     * @return string
     */
    protected function getRecordValue($record) {
        $values = '';
        if ($record['value']) {
            switch ($record['type']) {
                case 'int':
                    $values .= $record['value'] . ',';
                    break;
                default:
                    $values .= "'" . $record['value'] . "'" . ',';
            }
        }
        return $values;
    }

    /**
     * 
     * @param type $data
     */
    public function bind($data) {
        $this->_data = $data;
        $this->primary_key_value = false;
        foreach ($this->_data as $key => $record) {

            if ($record) {

                if (isset($record['primary']) && $record['primary'] == true) {
                    $this->primary_key = $key;
                    $this->primary_key_value = $record['value'];
                }
            }
        }
    }

}

