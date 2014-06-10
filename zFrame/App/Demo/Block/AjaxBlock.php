<?php

namespace App\Demo\Block;
use Lib\Block\BlockController;

class AjaxBlock extends BlockController{
    
    public function indexAction(){
        $this->message = 'Testing Index Block';
        //$this->setTemplate('Demo/View/Block/ajax.phtml');
    }
    
    public function helloAction(){
        $this->message = 'Testing Hello Block';
      //  $this->setTemplate('Demo/View/Block/ajax.phtml');
    }
}