<?php

namespace Lib\View;

use Lib\View\Yaml\Yaml;
use Lib\Config\Session;
use Lib\Defaults\MobileDetect;

class Asset {

  protected $module = null;
  protected $controller = null;
  protected $theme = null;
  protected $css_array = null;
  protected $js_array = null;
  protected $javascript = null;
  public static $asset = null;
  protected $asset_array = null;
  protected $application = null;

  public function __construct() {
    $this->js_array = $this->css_array = array();
    //set application name
    $this->application = Session::getValue('active_app');
  }

  /**
   * Ftech single instance of View Class
   * @return View
   */
  public static function getAsset() {
    if (Asset::$asset == null) {
      Asset::$asset = new Asset();
    }
    return Asset::$asset;
  }

  /**
   * 
   * @param type $module
   * @param type $controller
   */
  public function setDefaults($module, $controller) {
    $this->module = $module;
    $this->controller = $controller;
    //load yml file
    $asset_path = $this->application . DIRECTORY_SEPARATOR . $module . '/' . 'Config' . DIRECTORY_SEPARATOR . 'asset.yml';
    //load content from yml file
    $this->asset_array = Yaml::parse($asset_path);
  }

  /**
   * Fetch layout for executing controller
   * @return String
   */
  public function getLayout() {

    return $this->asset_array['default']['layout']['name'];
  }

  /**
   * Fetch layout for executing controller
   * @return String
   */
  public function getLayoutController() {

    return $this->asset_array['default']['layout']['controller'];
  }

  /**
   * 
   */
  public function loadCss($options = null) {
    //fetch default css fiels
    $css_asset_records = $options ? $options : $this->asset_array['default']['css'][$this->getDeviceName()];

    //get default them
    $theme = $this->asset_array['default']['theme'];

    foreach ($css_asset_records as $css_path) {

      echo '<link type="text/css" rel="stylesheet" href="/Skin/' . $theme . '/css/' . $this->getDeviceName() . '/' . $css_path . '">';
    }

    //set theme
    if ($this->theme == null) {
      $this->them = $theme;
    }
    //include user submited css
    if (isset($this->css_array)) {
      foreach ($this->css_array as $css_path) {
        echo '<link type="text/css" rel="stylesheet" href="/Skin/' . $this->theme . '/css/' . $css_path . '">';
      }
    }
  }

  public function loadJavascript($options = null) {
    // get default js file 
    $js_asset_records = $options ? $options : $this->asset_array['default']['javascript'][$this->getDeviceName()];
    //get default them
    $theme = $this->asset_array['default']['theme'];

    foreach ($js_asset_records as $key => $js_file_path) {
      if (!$options) {
        echo '<script type="text/javascript" src="/Skin/' . $this->theme . '/css/' . $js_file_path . '"></script>';
      } else if (isset($options[$js_file_path])) {
        echo '<script type="text/javascript" src="/Skin/' . $this->theme . '/css/' . $js_file_path . '"></script>';
      }
    }

    //include user submited css
    if (isset($this->javascript)) {
      foreach ($this->javascript as $js_file_path) {
        echo '<script type="text/javascript" src="/Skin/' . $this->theme . '/css/' . $js_file_path . '"></script>';
      }
    }
  }

  /**
   * 
   * @param type $css_path
   */
  public function addCss($css_path) {

    $this->css_array[] = $css_path;
  }

  /**
   * 
   * @param type $js_path
   */
  public function addJs($js_path) {
    $this->javascript->push($js_path);
  }

  private function getDeviceName() {
    $mobile_detect = new MobileDetect();
    return ($mobile_detect->isMobile() ? ($mobile_detect->isTablet() ? 'medium' : 'small') : 'default');
  }

}
