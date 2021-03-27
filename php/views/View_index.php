<?php


namespace php\views;


use php\core\View;

class View_index extends View
{
    protected function getContent($data) {
        $json = $data ? htmlspecialchars(json_encode($data)) : '';
        $dataData = $json ? "data-data='$json'" : '';

        return <<<HTML
        <div class="col-auto btn-group dropdown">
            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton2"
                    data-display="static"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Войти
            </button>
            <form class="dropdown-menu dropdown-menu-right   p-4" id="form-login">
                <div class="form-group">
                    <label for="user-login">Логин</label>
                    <input type="text" class="form-control" id="user-login" name="user-login" placeholder="Логин"
                           required>
                </div>
                <div class="form-group">
                    <label for="user-pass">Пароль</label>
                    <input type="password" class="form-control" id="user-pass" placeholder="Пароль" required>
                </div>
                <button type="submit" class="btn btn-primary">Войти</button>
            </form>
        </div>

</div>

<table class="mt-3" id="table" $dataData></table>
HTML;
    }


    protected function getJS() {
        return "<script src=\"/js/index.js\"></script>";
    }
}


