<?php

namespace Lib\Routing;

use Lib\Controller\Controller;
use Cache\RoutingPath;
use Lib\Http\Request;
use Lib\Block\Block;

class Routing {

    protected $controller = null;
    public $rout_found = false;

    /**
     * 
     * @param type $application
     */
    public function __construct($application) {

        //generate request uri from routing system
        $this->buildUri($application);
    }

    /**
     * 
     * @param type $application
     */
    public function buildUri($application) {
        //set default
        $this->rout_found = false;
        //get routing configuaration
        $rout = RoutingPath::$rout;

        //get request uri and process it
        $uri = $_SERVER['REQUEST_URI'];
        $uri = str_replace('=', '/', $uri);
        $uri = str_replace('?', '/', $uri);
        $uri = str_replace('&', '/', $uri);
        $parameters = explode('/', $uri);
        
        //request for homepage
        
        if ($uri == '/') {
          
            if (isset($rout['homepage'])) {
                $this->controller = new Controller($application);
                //set default parameters
                $this->controller->setDefaults($rout['homepage']['module'], $rout['homepage']['action']);
                $this->rout_found = true;
                return;
            } else {
                //throw exception
            }
        }

        //remove first parameter
        array_shift($parameters);
        
        //request is for action
        if ($parameters[0][0] != '_') {
          
            if (isset($rout['action'][$parameters[0]])) {
                $rout_records = $rout['action'][$parameters[0]];
            } else {
                //throw exception
            }
            //create controller
            $this->controller = new Controller($application);
            //iterat each rout object
            
            foreach ($rout_records as $rout_record) {
                //$rout_object = array_shift(array_values($rout_record));
                $rout_object = $rout_record;
                
                //build rout parameter
                $path = $rout_object['url'];
                $path_param = explode('/', $path);
                
                //copy uri parameters
                $uri_param = $parameters;
                
                //process uri parameters
                foreach ($path_param as $index => $param) {
                
                   //echo $param . '//';
                    if($param[0] == ':'){
                     
                        $uri_param[$index] = $path_param[$index];
                        $parameters[] = substr($param, 1);
                        $parameters[] = $parameters[$index];
                    }
                }
                //trim uri parameter
                $uri_param = array_slice($uri_param, 0, count($path_param));
                
                //build new uri
                $uri_path = implode('/', $uri_param);
                
                //compair uris
                if ($uri_path == $path) {

                    //set request parameters
                    Request::setParameters($parameters);
                    //set default parameters
                    
                    $this->controller->setDefaults($rout_object['path']['module'], $rout_object['path']['action']);
                    $this->rout_found = true;
                }
            }
        }
        //if request for block
        else {
            $block = substr($parameters[0], 1);

            if (isset($rout['block'][$block])) {
                $rout_records = $rout['block'][$block];
            } else {
                //throw exception
            }
            $this->controller = new Block('direct');
            //iterat each rout object
            foreach ($rout_records as $rout_record) {
                //$rout_object = array_shift(array_values($rout_record));
                $rout_object = $rout_record;
                //build rout parameter
                $path = $rout_object['url'];
                $path_param = explode('/', $path);
                //copy uri parameters
                $uri_param = $parameters;
                //process uri parameters
                foreach ($path_param as $index => $param) {
                    if ($param[0] == ':') {
                        $uri_param[$index] = $path_param[$index];
                        $parameters[] = substr($param, 1);
                        $parameters[] = $parameters[$index];
                    }
                }

                //trim uri parameter
                $uri_param = array_slice($uri_param, 0, count($path_param));
                //build new uri
                $uri_path = implode('/', $uri_param);
                //compair uris
                if ($uri_path == $path) {

                    //set request parameters
                    Request::setParameters($parameters);
                    //set default parameters
                    $this->controller->setDefaults($block, $rout_object['path']['controller'], $rout_object['path']['action']);
                    $this->rout_found = true;
                }
            }
        }
    }

    /**
     * 
     * @return type
     */
    public function getController() {
        return $this->controller;
    }

}
