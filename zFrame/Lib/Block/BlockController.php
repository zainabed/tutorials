<?php

namespace Lib\Block;

/**
 * 
 */
class BlockController {

    protected $module;
    protected $block;
    protected $action;
    protected $template;

    /**
     * 
     * @param String $module Module for block
     * @param String $block Block name
     * @param String $action Block action
     */
    public function __construct($module, $block, $action) {
        //set default class parameters
        $this->module = $module;
        $this->block = $block;
        $this->action = $action;
    }

    public function renderView($template) {
        require $template;
    }

    public function setTemplate($template) {
        $this->template = $template;
    }
    public function getTemplate(){
        return $this->template;
    }

}