<?php

class ResetPasswordController{
    
    private $model;

    public function __construct(ResetPasswordModel $model) {
        $this->model = $model;
    }

}