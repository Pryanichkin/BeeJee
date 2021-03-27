<?php


namespace php\core;


class Route
{
    static function start() {
        $namePhp = array_pop(explode('/', $_SERVER['REQUEST_URI']));
        $name = explode('.', $namePhp)[0];

        $modelClass = '\php\models\Model_' . $name;
        $controllerClass = '\php\controllers\Controller_' . $name;
        $viewClass = '\php\views\View_' . $name;

        $controller = new $controllerClass(new $modelClass, new $viewClass);
        $controller->action();
    }
}