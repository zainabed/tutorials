<?php

namespace Lib\Config;

use Lib\Routing\Routing;
use Lib\Config\Session;
use Config\AppConfig;
use Config\ModuleConfig;
use Lib\View\Yaml\Yaml;

/**
 * 
 */
class ApplicationConfig {

  protected $routing = null;
  protected $application = null;
  protected $module_array = null;

  /**
   * 
   */
  public function __construct($application) {
    $this->application = $application;
    $this->generateConfig(); // generate default config

    

    //store application name is session
    Session::setValue('active_app', $application);
    $this->routing = new Routing($application);
    if ($this->routing->rout_found == false) {
      require '\Web\404.php';
    }
  }

  /**
   * Fetch controller for request
   * @return Controller
   */
  public function getController() {
    if ($this->routing->rout_found == true) {
      return $this->routing->getController();
    }
  }

  /**
   * Generate routing file for each registered module
   */
  protected function generateConfig() {
    
    if (!file_exists(AppConfig::getCachePath() . DIRECTORY_SEPARATOR . 'RoutingPath.php')) {
      $routing_config_array = array();
      if (is_array(ModuleConfig::$module_config)) {

        foreach (ModuleConfig::$module_config as $module_name) {
          $app_routing_config_path = AppConfig::getRootPath() . $this->application . DIRECTORY_SEPARATOR . $module_name . DIRECTORY_SEPARATOR . 'Config' . DIRECTORY_SEPARATOR . 'routing.yml';
          
          $temp_routing_config_array = Yaml::parse($app_routing_config_path);
          
          $routing_config_array = array_merge($routing_config_array, $temp_routing_config_array);
        }
        
      }
      $routing_config_array = var_export($routing_config_array, true);
      $routing_class = <<<EOT
<?php 
              
namespace Cache;
              
class RoutingPath{
           public static \$rout = $routing_config_array;
    }          
EOT;
      file_put_contents(AppConfig::getCachePath() . DIRECTORY_SEPARATOR . 'RoutingPath.php',$routing_class );
    }
  }

}