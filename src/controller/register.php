<?php

class RegisterController{
    
    private $model;

    public function __construct(RegisterModel $model) {
        $this->model = $model;
    }

}