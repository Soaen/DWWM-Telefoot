<?php

class NewPasswordController{
    
    private $model;

    public function __construct(NewPasswordModel $model) {
        $this->model = $model;
    }

}