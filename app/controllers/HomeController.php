<?php

class HomeController extends MainController {
    
    public function indexAction($query = array()){        
        //var_dump($this->_model->findAll());
        $this->_template->setVariable("text",$this->_model->findAll());
    }           
    
}