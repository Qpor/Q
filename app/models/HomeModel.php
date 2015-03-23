<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class HomeModel extends MainModel {

    protected $tablename = "SB_MISSION";
    protected $sql;

    public function findAll(){
        $this->sql = "SELECT b.text FROM " . $this->tablename . " a " .
                     "INNER JOIN SB_TR_OTHER b on a.description_id = b.id " .
                     "WHERE b.language_id = " . LANGUAGEID;

        return $this->db->query($this->sql);
    }
}