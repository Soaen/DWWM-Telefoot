<?php

class LoginModel{

    public $db; 
    
    public function __construct(PDO $db){
        $this->db = $db;
    }

}