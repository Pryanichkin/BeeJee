<?php


namespace php\core;

abstract class Controller {

    public Model $model;
    public View $view;

    function __construct(Model $model,View $view)
    {
        $this->model = $model;
        $this->view = $view;
    }

    abstract function action();
}