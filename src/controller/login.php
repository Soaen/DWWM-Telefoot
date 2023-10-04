<?php

class LoginController{
    
    private $model;

    public function __construct(LoginModel $model) {
        $this->model = $model;
    }

}