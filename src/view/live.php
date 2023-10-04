<?php

class LiveView{

    public $controller;
    public $template;

    public function __construct(LiveController $controller) {
        $this -> controller = $controller;
        $this -> template = DIR_TEMPLATE . "live.php";
    }

    public function render() {

        require($this->template);

    }

}