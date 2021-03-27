<?php


namespace php\core;


abstract class View
{
    abstract protected function getContent($data);
    abstract protected function getJS();

    function show($data)
    {
        echo <<<HTML
<!doctype html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
          integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css"
          integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <link rel="stylesheet" href="https://unpkg.com/bootstrap-table@1.18.2/dist/bootstrap-table.min.css">
    <title>BeeJee Test</title>
</head>
<body class="bg-light">
<div class="container">

<div class="row justify-content-between m-2">

        <div class="col-4 btn-group dropdown">
            <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Добавить новую задачу
            </button>
            <form class="w-100 dropdown-menu p-4" id="form-add-task">
                <div class="form-group">
                    <label for="user-name">Имя пользователя</label>
                    <input type="text" class="form-control" id="user-name" name="user-name" placeholder="Имя"
                           required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="user@example.com"
                           required>
                </div>
                <div class="form-group">
                    <label for="task">Задача</label>
                    <textarea name="task" class="form-control" id="task"
                              placeholder="Задача" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Записать</button>
            </form>
        </div>
{$this->getContent($data)}
   
<div aria-live="polite" aria-atomic="true">
    <!-- Position it -->
    <div style="position: absolute; bottom: 1%; right: 1%;">

        <!-- Then put toasts within -->
        <div id="toast" class="toast hide" role="alert" aria-live="assertive" aria-atomic="true" data-delay="3000">
            <div class="toast-header">
                <strong id="toast-title" class="mr-auto"></strong>
                <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div id="toast-body" class="toast-body">

            </div>
        </div>
    </div>
</div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"
        integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg=="
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js"
        integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF"
        crossorigin="anonymous"></script>
<script src="https://unpkg.com/bootstrap-table@1.18.2/dist/bootstrap-table.min.js"></script>
<script src="/js/bootstrap-table-ru-RU.js"></script>
<script src="/js/main.js"></script>
{$this->getJS()}
</body>
</html>
HTML;
    }
}