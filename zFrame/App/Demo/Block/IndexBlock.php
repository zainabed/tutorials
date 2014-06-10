<?php

namespace App\Demo\Block;

use Lib\Block\BlockController;

class IndexBlock extends BlockController{
    
    public function indexAction(){
        $this->block_message = "Block Message";
    }
    
    public function leftAction(){
        $this->block_message = 'left message';
    }
    
    public function rightAction(){
        $this->block_message = 'right message';
    }
}