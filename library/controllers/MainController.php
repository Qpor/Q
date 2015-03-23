<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class MainController {
    
    protected $_controller;
    protected $_action;   
    protected $_template;
    protected $_model;
    protected $db;
    
    public function __construct($model, $controller, $action) {
        $this->_controller = $controller;
        $this->_action = $action;    
        $this->_template = new MainTemplate($controller,$action);

        $this->_model = new $model();
    }
    
    function __destruct() {
        $this->_template->render();
    }
    
    public function resetTemplate($controller,$action){
        $this->_template = new MainTemplate($controller, $action);
    }
    
    public function errorAction($error = "Error."){
        $this->_controller = "error";
        $this->_action = "error";
        $this->_template = new MainTemplate($this->_controller,$this->_action);

        $this->_template->setVariable("error",$error);
    }
}