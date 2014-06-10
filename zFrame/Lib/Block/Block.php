<?php

namespace Lib\Block;

use Lib\Config\Session;
use Lib\View\Yaml\Yaml;
use Config\ModuleConfig;

class Block {

    protected $block_helper = null;
    protected $content = null;
    private $application = null;
    protected $controller = null;
    protected $module = null;
    protected $action = null;
    protected $block_records = null;
    protected $template = null;
    protected $block_namespace = null;

    /**
     * 
     * @param String $action
     */
    public function __construct($action = null) {
        //set application name
        $this->application = Session::getValue('active_app');

        if ($action == null) {
            //get module config
            $module_config = ModuleConfig::$module_config;
            //iterate each module to fetch block configuration
            $this->block_records = array();
            foreach ($module_config as $module) {

                $this->block_records = array_merge($this->block_records, Yaml::parse($this->application . '/' . $module . '/Config/layout.yml'));
            }
        }
    }

    /**
     * 
     * @param type $module
     * @param type $controller
     * @param type $action
     * @param type $template
     */
    public function setDefaults($module, $controller, $action, $template = null) {
        $this->module = ucfirst($module);
        $this->controller = ucfirst($controller);
        $this->action = $action;
        $this->template = $template;
        //get block namespace
        $this->block_namespace = $this->getModuleNamespace($this->module, $this->controller);
    }

    /**
     * 
     * @param type $module_namespace
     * @param type $template
     * @throws Exception
     */
    public function include_block($module_namespace, $template) {
        // generate block components
        $block_component = explode('/', $module_namespace);
        // if block dose not include module, block and action then throw exception
        if (count($block_component) < 3) {
            throw new Exception('Invalid Block Parameters');
        }
        //set default properties
        $this->module = $block_component[0];
        $this->controller = $block_component[1];
        $this->action = $block_component[2];

        //get block namespace
        $this->block_namespace = $this->getModuleNamespace($this->module, $this->controller);

        // create block helper
        //execute block
        $this->beginBlock();
        //load block template
        $this->loadTemplate($template);
    }

    /**
     * 
     * @param type $module
     * @param type $block
     * @return type
     */
    private function getModuleNamespace($module, $block) {
        return $this->application . '\\' . $module . '\\Block\\' . $block . 'Block';
    }

    /**
     * 
     * @param String $template
     * @param String $inputs
     */
    public function include_template($template, $inputs) {
        $this->content = $inputs;
        if ($template) {
            $template = str_replace('/', '\\', $template);
            $template = "\\$this->application\\" . $template;
            require $template;
        } else {
            //throw exception
        }
    }

    /**
     * 
     * @param type $position
     */
    public function renderDefault($position) {
        //get block records from yml file

        $block_records = $this->block_records['default']['blocks'][$position];
        //iterate each blocks

        foreach ($block_records as $block_name => $block_parameters) {

            $this->include_block($block_parameters['block'], $block_parameters['template']);
        }
    }

    /**
     * 
     * @param type $module_namespace
     * @throws Exception
     */
    public function beginBlock() {
        if (!$this->block_namespace) {
            //throw execption
        }
        
        $this->block_helper = new $this->block_namespace($this->module, $this->controller, $this->action);
        // execute block action
        call_user_func(array($this->block_helper, $this->action . 'Action'));
    }

    /**
     * 
     * @param type $template
     */
    public function loadTemplate($template = null) {
        if ($template || $this->block_helper->getTemplate()) {
            $template = $template ? $template : $this->block_helper->getTemplate();
            $template = str_replace('/', DIRECTORY_SEPARATOR, $template);
            $template = $this->application . DIRECTORY_SEPARATOR . $template;
            //render block template
            $this->block_helper->renderView($template);
        } else {
            //throw exception
        }
    }

    /**
     * 
     */
    public function run() {
        $this->beginBlock();
        $this->loadTemplate();
    }

}
