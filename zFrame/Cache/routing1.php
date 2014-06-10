<?php

namespace Cache;

class Routing {

  public static $paths = array(
      'action' =>
      array(
          'demo' =>
          array(
              'demo_index' =>
              array(
                  'url' => 'demo/:request',
                  'path' =>
                  array(
                      'module' => 'demo',
                      'action' => 'index',
                  ),
              ),
              'demo_hello' =>
              array(
                  'url' => 'demo/hello',
                  'path' =>
                  array(
                      'module' => 'demo',
                      'action' => 'hello',
                  ),
              ),
          ),
      ),
      'block' =>
      array(
          'demo' =>
          array(
              'demo_index' =>
              array(
                  'url' => '_demo/index',
                  'path' =>
                  array(
                      'controller' => 'ajax',
                      'action' => 'index',
                  ),
              ),
              'demo_hello' =>
              array(
                  'url' => '_demo/index',
                  'path' =>
                  array(
                      'controller' => 'ajax',
                      'action' => 'hello',
                  ),
              ),
          ),
      ),
  );

}

