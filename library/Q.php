<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Q {
    private static $generalTexts;

    public static function run(){
        include(DEFAULT_PATH . DS . "config" . DS . "main.config.php");
        include(DEFAULT_PATH . DS . "cache" . DS . "localisation" . DS . LANGUAGE . DS . "general.lang.php");
        self::$generalTexts = $generalTexts;        
        //include("config/Router.php");
        // Todo database configuration include and database instantiation
        //include("database/database.config.php");
        include(DEFAULT_PATH . DS . "database" . DS . "Database.php");
        self::router();
    }

    public static function translate($text,$params = array()){        
        $translatedText = $text;
        if(isset(self::$generalTexts[$text])){
            $translatedText = self::$generalTexts[$text];            
        }       
       
        if(!empty($params)){
            foreach($params as $pattern => $value){
                $translatedText = preg_replace($pattern, $value, $translatedText);  
            }            
        }
        
       return $translatedText;
    }

    private static function router(){
        $url = $_GET['route'];

        if($url === null || $url == ""){
            $url = DEFAULT_PAGE;
        }

        $urlArray = explode("/",$url);

        if(!empty($urlArray)){
            $routePieces = self::buildRoute($urlArray);
            if(class_exists($routePieces["controller"])){
                $dispatch = new $routePieces["controller"](
                    $routePieces["modelName"],
                    $routePieces["controllerName"],
                    $routePieces["actionName"]
                );
                
                if(method_exists($dispatch, $routePieces["action"])){                    
                    try{
                        call_user_func(array($dispatch,$routePieces["action"]),$routePieces["query"]);
                        //$dispatch->$routePieces["action"]();
                    } catch (Exception $e){
                        $dispatch->errorAction($e);
                    }
                } else {                    
                    $action = DEFAULT_ACTION . "Action";
                    $dispatch->resetTemplate($routePieces["controllerName"],DEFAULT_ACTION);
                    try{                        
                        call_user_func(array($dispatch,$action),$routePieces["query"]);                           
                    } catch (Exception $e){                                  
                        $dispatch->errorAction($e);
                    }                    
                }
            } else {
                $routePieces = self::buildRoute(explode("/",DEFAULT_PAGE));
                $dispatch = new $routePieces["controller"](
                    $routePieces["modelName"],
                    $routePieces["controllerName"],
                    $routePieces["actionName"]
                );
                $dispatch->errorAction("Page doesn't exists");
            }

        }
    }

    private static function buildRoute($urlArray){
        $controller = $urlArray[0];
        array_shift($urlArray);
        $action = $urlArray[0];
        array_shift($urlArray);
        $query = $urlArray;

        $data["controllerName"] = strtolower($controller);
        $data["controller"] = ucwords($controller);
        $data["controller"] .= "Controller";

        $data["modelName"] = ucwords($data["controllerName"]) . "Model";

        if($action == ""){
            $action = DEFAULT_ACTION;
        }

        $data["actionName"] = strtolower($action);
        $data["action"] = $action . "Action";
        
        $data["query"] = $query;

        return $data;
    }
}