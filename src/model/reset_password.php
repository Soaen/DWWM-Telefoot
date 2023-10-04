<?php

class ResetPasswordModel{

    public $db; 
    
    public function __construct(PDO $db){
        $this->db = $db;
    }
}