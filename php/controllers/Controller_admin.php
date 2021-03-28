<?php

namespace php\controllers;

use php\core\Controller;

class Controller_admin extends Controller
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

                case 'EXIT':
                    session_start();
                    $_SESSION['access'] = 'denied';
                    exit(true);

                case 'EDIT':
                    session_start();
                    if (!isset($_SESSION['access']) || $_SESSION['access'] == 'denied') {
                        exit ('access_denied');
                    }

                    $id = htmlspecialchars($_POST['id']);
                    $fieldName = empty($_POST['task']) ? 'is_done' : 'task';
                    $fieldValue = $_POST[$fieldName];
                    $isEdit = empty($_POST['task']) ? 0 : 1;

                    exit ($this->model->editData($id, $isEdit, [$fieldName => $fieldValue]));
            }
        } else {
            session_start();
            if (!isset($_SESSION['access']) || $_SESSION['access'] == 'denied') {
                header("refresh:5;url=index.php");
                echo '<h1>Ваша Авторизация устарела.</h1> <p>Вы будете перемещены на главную страницу через 5 секунд.</p>';
                exit();
            }

            $this->view->show($this->model->getData());
        }
    }
}



