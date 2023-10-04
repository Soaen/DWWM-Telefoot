<?php

class LiveModel{

    public $db; 
    
    public function __construct(PDO $db){
        $this->db = $db;
    }
}