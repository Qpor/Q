<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class Database {
    
    private static $instance = null;
    private $pdo;
    private $error = false;
    
    private function __construct() {
        require_once(DEFAULT_PATH . DS . "config" . DS . "database.config.php");

        try{
            $this->pdo = new PDO(DBDRIVER . ":host=" . DBHOST . ";dbname=" . DBNAME, DBUSER, DBPASSWORD);
            $this->pdo->query("SET NAMES " . DBCHARSET);

        } catch(Exception $e){            
            $this->error = "Cannot connect to database. Check the configuration.";
        }
    }
    
    public function getInstance(){
        if(self::$instance === null){            
            self::$instance = new Self();                        
        }
        
        return self::$instance;        
    }
    
    public function query($sql,$params = array()){
        $resultData = array();
        if($this->pdo !== null){

            if(!empty($params)){
                $preparedQuery = $this->pdo->prepare($sql);

                $query = $preparedQuery->execute($params);

                if($query){
                    $resultData = $preparedQuery->fetch();
                } else {
                    $this->error = "Query failed: " . $sql;
                }

            } else {
                $query = $this->pdo->query($sql);

                if($query){
                    $query->execute();
                    while($row = $query->fetch()){
                        $resultData[] = $row;
                    }
                } else {
                    $this->error = "Query failed: " . $sql;
                }
            }
        }

        return $resultData;
    }

    public function getError(){
        return $this->error;
    }
    
}
