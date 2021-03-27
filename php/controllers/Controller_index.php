<?php

namespace php\controllers;

use php\core\Controller;

class Controller_index extends Controller
{
    function action() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            switch ($_POST['type']) {
                case 'ADD':
                    $username = htmlspecialchars($_POST['username']);
                    $email = htmlspecialchars($_POST['email']);
                    $task = htmlspecialchars($_POST['task']);

                    exit ($this->model->addData([
                        'username' => $username,
                        'email' => $email,
                        'task' => $task
                    ]));

                case 'LOGIN':
                    $login = htmlspecialchars($_POST['login']);
                    $password = htmlspecialchars($_POST['password']);
                    if ($login != 'admin' || $password != '123') {
                        exit(false);
                    } else {
                        session_start();
                        $_SESSION['access'] = 'granted';
                        exit(true);
                    }
            }
        } else {
            $this->view->show($this->model->getData());
        }
    }
}



