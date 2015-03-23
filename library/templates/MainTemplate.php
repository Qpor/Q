<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class MainTemplate{
    
    private $_controller;
    private $_action;
    private $_variables;

    private $_menuElements = array();
    
    public function __construct($controller,$action) {
        $this->_controller = $controller;
        $this->_action = $action;

        $this->_menuElements = array(
            0 => array("name" => "Home"),
            1 => array("name" => "About"),
            2 => array("name" => "Macska")
            );
    }    

    private function header(){
        $viewPath = DEFAULT_PATH . DS . "app" . DS . "views" . DS . "_default" . DS . "header.php";
        if(file_exists($viewPath)){
            include($viewPath);
        }        
    }
    
    private function footer(){
        $viewPath = DEFAULT_PATH . DS . "app" . DS . "views" . DS . "_default" . DS . "footer.php";
        if(file_exists($viewPath)){
            include($viewPath);
        }
    }
    
    private function menu(){        
        $viewPath = DEFAULT_PATH . DS . "app" . DS . "views" . DS . "_default" . DS . "menu.php";
        if(file_exists($viewPath)){
            $menuElements = $this->_menuElements;
            include($viewPath);
        }        
    }
    
    public function render(){        
        $this->header();
        $this->menu();

        if($this->_action !== "error" && $this->_controller !== "error"){            
            $viewPath = DEFAULT_PATH . DS . "app" . DS . "views" . DS . $this->_controller . DS . $this->_action . ".php";            
            if(file_exists($viewPath)){
                $data = $this->_variables;
                include($viewPath);
            }
        } else {
            $viewPath = DEFAULT_PATH . DS . "app" . DS . "views" . DS . "_default" . DS . $this->_action . ".php";
            if(file_exists($viewPath)){
                $data = $this->_variables;
                include($viewPath);
            }
        }
        
        $this->footer();
    }
    
    public function setVariable($name,$data){
        $this->_variables[$name] = $data;
    }
    
}