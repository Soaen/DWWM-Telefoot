<?php


class LiveController{

    private $model;

    public function __construct(LiveModel $model) {
        $this->model = $model;
    }

}