<?php

namespace App\Demo\Model;

use Lib\Database\Record;

class TestModel extends Record {

    protected $columns = array('id' => array(
            'type' => 'int',
            'value' => '',
            'size' => '11',
            'primary' => true
        ), 'name' => array(
            'type' => 'string',
            'value' => '',
            'size' => '30'
        ), 'title' => array(
            'type' => 'string',
            'value' => '',
            'size' => '30'
    ));

    public function __construct() {
        parent::__construct(__CLASS__);
    }

}