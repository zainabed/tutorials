<?php

use Lib\Config\ApplicationConfig;

//load autoload file
require_once 'autoload.php';
error_reporting(E_ALL);
//create application configuration object
$application_config = new ApplicationConfig('App');

//load controller
$controller = $application_config->getController();
//execute request
if ($controller) {
  $controller->run();
}

