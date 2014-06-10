<?php

namespace Lib\Controller;

use Lib\Defaults\MobileDetect;

/**
 * 
 */
class Controller {

  protected $config = null;
  protected $module = null;
  protected $controller = null;
  protected $action = null;
  protected $layout = null;
  protected $view = null;
  protected $moduel_path = null;
  protected $content = null;
  protected $view_helper = null;
  protected $application = null;

  /**
   * 
   * @param String $application
   */
  public function __construct($application) {

    $this->application = '\\' . $application . '\\';
  }

  /**
   * Set module and action names
   * @param type $module Module Name
   * @param type $action Action Name
   */
  public function setDefaults($module, $action) {
    $this->module = $this->controller = ucwords($module);
    $this->action = $action . 'Action';
    $this->view = $action;
  }

  /**
   * Execute request and begin action of controller
   * and render view
   */
  public function run() {
    //load layout, execute action and render view
    $this->loadLayout();
    $this->beginAction();
    $this->renderOutput();
  }

  public function loadLayout() {
    
  }

  /**
   * Execute controller's action
   */
  public function beginAction() {
    //create module file
    $this->moduel_path = $this->application . $this->module;
    //create module object
    $controller_namespace = $this->moduel_path . '\\Controller\\' . $this->getDeviceAction() . $this->controller . 'Controller';
    //get action controller object alias as view_helper
    $this->view_helper = new $controller_namespace;

    //bind parameters
    $this->view_helper->setDefault($this->module, $this->controller, $this->view);
    //enable assest for request action
    $this->view_helper->enableAsset();
    //excute action
    call_user_func(array($this->view_helper, $this->action));
  }

  private function getDeviceAction() {
    $mobile_detect = new MobileDetect();
    return ($mobile_detect->isMobile() ? ($mobile_detect->isTablet() ? 'medium\\' : 'small\\') : '');
  }

  /**
   * Render Layout and its componenets
   */
  public function renderOutput() {
    $this->renderAction();
    // include layout
    //require_once $this->application . '\\' . $this->view_helper->asset->getLayoutController() . '\\Layout\\' . $this->getDeviceAction() . $this->view_helper->asset->getLayout() . '.phtml';
    $path = $this->application . '\\' . $this->view_helper->asset->getLayoutController() . '\\Layout\\' . $this->getDeviceAction() . $this->view_helper->asset->getLayout() . '.phtml';
    $this->view_helper->renderOutput($path);
  }

  /**
   * Render action view
   */
  public function renderAction() {
    //ob_start();
    //build action view path
    $path = $this->moduel_path . '\\View\\' . $this->getDeviceAction();
    //include action view
    $this->view_helper->renderView($path);
    //$this->content = ob_get_clean();
  }

}