<?php

namespace Lib\Database;

use Lib\Database\DatabaseAbstract;

class DatabaseManager extends DatabaseAbstract {

    public function __construct() {
        parent::setup();
    }

    public function save() {
        parent::save();
    }

}