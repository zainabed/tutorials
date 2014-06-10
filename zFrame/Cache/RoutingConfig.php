<?php

namespace Cache;

class RoutingConfig {

  public static $rout = array(
      'homepage' =>
      array('module' => 'demo', 'action' => 'index'),
      'action' =>
      array('demo' =>
          array(
              array('demo_index' =>
                  array('path' => 'demo/:request',
                      'default' => array('module' => 'demo', 'action' => 'index'))),
              array('demo_hello' =>
                  array('path' => 'demo/hello',
                      'default' => array('module' => 'demo', 'action' => 'hello')))
          )),
      'block' =>
      array('demo' =>
          array(
              array('demo_index' =>
                  array('path' => '_demo/index',
                      'default' => array('controller' => 'ajax', 'action' => 'index'))),
              array('demo_hello' =>
                  array('path' => '_demo/hello',
                      'default' => array('controller' => 'ajax', 'action' => 'hello')))
          ))
  );

}