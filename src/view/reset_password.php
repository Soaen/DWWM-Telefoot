<?php

class ResetPasswordView{
    
    public $controller;
    public $template;

    public function __construct(ResetPasswordController $controller) {
        $this -> controller = $controller;
        $this -> template = DIR_TEMPLATE . "reset_password.php";
    }

    public function render() {


        require($this->template);

    }

}