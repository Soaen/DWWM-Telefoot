<?php

class RegisterView{
    
    public $controller;
    public $template;

    public function __construct(RegisterController $controller) {
        $this -> controller = $controller;
        $this -> template = DIR_TEMPLATE . "register.php";
    }

    public function render() {


        require($this->template);

    }

}