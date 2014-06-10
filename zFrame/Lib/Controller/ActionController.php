<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Lib\Controller;

use Lib\Block\Block;
use Lib\View\Asset;
use Lib\View\View;

class ActionController {

  protected $block = null;
  public $asset = null;
  protected $module = null;
  protected $controller = null;
  protected $template = null;
  protected $view = null;
  protected $content = null;

  public function __construct() {
    $this->view = View::getView();
  }

  public function getView() {
    return $this->view;
  }

  /**
   * Create block object
   */
  public function enableBlock() {
    $this->block = new Block();
  }

  /**
   * Enable assets (css, js) for requested controller
   */
  public function enableAsset() {
    //get asset records
    $this->asset = Asset::getAsset();
    //set asset for given module and controller
    $this->asset->setDefaults($this->module, $this->controller);
  }

  /**
   * Fetch block helper object
   * @return type
   */
  public function getBlockHelper() {
    return $this->block;
  }

  

  /**
   * Set default parameters for action controller object
   * @param String $module Module
   * @param String $controller Controller
   * @param String $view View 
   */
  public function setDefault($module, $controller, $view) {
    $this->module = $module;
    $this->controller = $controller;
    $this->template = $view;
  }

  /**
   * Render action controller view
   * @param type $template
   */
  public function renderView($template_path) {
    ob_start();
    //build view path
    $template = $template_path . $this->template . '.phtml';
    //include view
    require $template;
    $this->content = ob_get_clean();
  }

  /**
   * Set view parameter for action controller
   * @param String $view View
   */
  public function setTemplate($view) {
    $this->template = $view;
  }

  /**
   * Get view parameter for action controller
   * @return String
   */
  public function getTemplate() {
    return $this->template;
  }
  
  public function renderOutput($path){
    require $path;
  }

}
