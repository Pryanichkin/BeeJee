<?php


namespace php\views;


use php\core\View;

class View_admin extends View
{
    protected function getContent($data) {
        $json = $data ? htmlspecialchars(json_encode($data)) : '';
        $dataData = $json ? "data-data='$json'" : '';

        return <<<HTML
        <div class="col-auto btn-group dropdown">
            <button class="btn btn-dark" type="button" id="btn-exit">
                Выход
            </button>
        </div>

</div>

<div class="modal fade" id="modal-edit-task" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Изменить задачу</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form>
          <div class="form-group">
            <label for="modal-task-text" class="col-form-label">Задача</label>
            <textarea class="form-control" id="modal-task-text"></textarea>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Отменить</button>
        <button type="button" class="btn btn-primary" id="modal-task-save">Сохранить</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modal-edit-status" tabindex="-1" aria-labelledby="exampleModalLabel2" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel2">Изменить статус выполнения задачи</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="exampleRadios" id="radio-status-done" value="1" checked>
              <label class="form-check-label" for="radio-status-done">
                Выполнена
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="exampleRadios" id="radio-status-not-done" value="0">
              <label class="form-check-label" for="radio-status-not-done">
                НЕ выполнена
              </label>
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Отменить</button>
        <button type="button" class="btn btn-primary" id="modal-status-save">Сохранить</button>
      </div>
    </div>
  </div>
</div>

<table class="mt-3" id="table" $dataData></table>
HTML;
    }


    protected function getJS() {
        return "<script src=\"/js/admin.js\"></script>";
    }
}


