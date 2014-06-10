<?php

namespace Lib\View;

use Lib\Config\Session;
use Lib\View\Yaml\Yaml;

class Block {

    protected $application = null;
    protected $controller = null;
    
    public function __construct($controller) {
        $this->application = Session::getValue('active_app');
        $this->controller = $controller;
    }
    
    public function loadConfig(){
        $config_file_path = '\\' . $this->application . '\\'.$this->controller .'\\Config\\layout.yml';
        if(file_exists($config_file_path)){
          return Yaml::parse($config_file_path);
        }else{
            //throw exception
        }
        
    }

}