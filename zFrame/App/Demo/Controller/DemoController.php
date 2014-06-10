<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Demo\Controller;

use Lib\Controller\ActionController;
use Lib\Http\Request;
use App\Demo\Model\TestModel;

class DemoController extends ActionController {

    public function indexAction() {
        $this->test_object = "Test Message";
        $request = new Request();
        $test_model = new TestModel();
        $test_model->setId(2);
        $test_model->setName('zain');
        $test_model->setTitle('zain');
        $test_model->save();
        
        $this->id = $request->id;
        $this->enableBlock();
    }

    public function helloAction() {
        $this->test_object = "hello world!";
        $request = new Request();
        $this->id = $request->id;
        //$this->setView('index');
        $this->enableBlock();
    }

}
