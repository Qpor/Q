<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Autoloader {              
    
    public static function ModuleLoader($name){
        include(DEFAULT_PATH . DS . "app" . DS . "controllers" . DS . $name . ".php");
    }
    
    public static function ModelLoader($name){
        include(DEFAULT_PATH . DS . "app" . DS . "models" . DS . $name . ".php");
    }    
    
    public static function MainControllerLoader($name){
        include(DEFAULT_PATH . DS . "library" . DS . "controllers" . DS . $name . ".php");
    }        
    
    public static function MainModelLoader($name){
        include(DEFAULT_PATH . DS . "library" . DS . "models" . DS . $name . ".php");
    }            
    
    public static function TemplateLoader($name){
        include(DEFAULT_PATH . DS . "library" . DS . "templates" . DS . $name . ".php");
    }    
    
    public static function AppLoader($name){        
        include(DEFAULT_PATH . DS . "library" . DS . $name . ".php");
    }    
}

spl_autoload_register("Autoloader::ModuleLoader");
spl_autoload_register("Autoloader::MainControllerLoader");
spl_autoload_register("Autoloader::MainModelLoader");
spl_autoload_register("Autoloader::TemplateLoader");
spl_autoload_register("Autoloader::AppLoader");
spl_autoload_register("Autoloader::ModelLoader");