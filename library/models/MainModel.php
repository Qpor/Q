<?php

/*
 *
 * MainModel:
 *
 * Purpose:
 *  It has the most common functions and attributes of a model
 * */

class MainModel {

    protected $tablename;
    protected $db;
    protected $sql;

    public function __construct(){
        $this->db = Database::getInstance();
    }

    public function findAll(){
        $result = $this->db->query("SELECT * FROM " . $this->tablename);

        return $result;
    }

    public function find($id){
        $result = $this->db->query("SELECT * FROM " . $this->tablename . " WHERE id = " . $id);

        return $result;
    }

    public function numRows(){

    }
}