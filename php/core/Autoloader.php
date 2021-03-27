<?php

namespace php\core;

class AutoLoader
{
    public static function register() {
        spl_autoload_register(function ($class) {
            $path = realpath($_SERVER['DOCUMENT_ROOT']
                . DIRECTORY_SEPARATOR
                . '..'
                . DIRECTORY_SEPARATOR
                . str_replace('\\', DIRECTORY_SEPARATOR, $class)
                . '.php');

            if ($path && file_exists($path)) {
                require_once $path;
                return true;
            }
            return false;
        });
    }
}

AutoLoader::register();