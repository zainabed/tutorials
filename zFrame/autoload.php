<?php

// auto load files from their namespace
spl_autoload_register(function ($class) {
          
          // get class name
          $class = str_replace('\\', DIRECTORY_SEPARATOR, $class);
          // load class file 
          include_once (__DIR__ . DIRECTORY_SEPARATOR . $class . '.php');
         // echo $class . '<br>';
        });