<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Config;
class AppConfig {

    public static $lib_path = null;

    public static function getLibPath() {
      return __DIR__ . '/../Lib';   
    }
    
    public static function getConfigPath() {
      return __DIR__ . '/../Config';   
    }
    
    public static function getCachePath() {
      return __DIR__ . '/../Cache';   
    }
    
    public static function getRootPath() {
      return __DIR__ . '/../';   
    }
    

}
