let $table = $('#table');

function initTable() {
    $table
        .bootstrapTable('destroy')
        .bootstrapTable({
            columns: [
                {
                    title: 'Имя пользователя',
                    field: 'username',
                    align: 'center',
                    valign: 'middle',
                    sortable: true
                },
                {
                    title: 'Email',
                    field: 'email',
                    align: 'center',
                    valign: 'middle',
                    sortable: true,
                },
                {
                    title: 'Текст задачи',
                    field: 'task',
                    align: 'center',
                    valign: 'middle',
                    sortable: true,
                },
                {
                    title: 'Статус',
                    field: 'is_done',
                    align: 'center',
                    valign: 'middle',
                    sortable: true,
                    formatter: doneFormatter
                }
            ],
            pagination: true,
            pageSize: 3,
            paginationLoop: false,
            onDblClickCell: function (field, value, row, $element) {
                if (field == 'task') {
                    $('#modal-task-text').val(value);
                    let $mts = $('#modal-task-save');
                    $mts.data('index', $element.parent().data('index'));
                    $mts.data('id', row['id']);
                    $mts.data('value', value);
                    $('#modal-edit-task').modal('show');
                } else if (field == 'is_done') {
                    value == 1 ? $('#radio-status-done').prop('checked', true) : $('#radio-status-not-done').prop('checked', true);

                    let $mts = $('#modal-task-save');
                    $mts.data('index', $element.parent().data('index'));
                    $mts.data('id', row['id']);
                    $('#modal-edit-status').modal('show');
                }
            },
            locale: 'ru-RU'
        });


}

function doneFormatter(v, r) {
    let status = '';
    status += v == 1 ? '<span class="badge badge-pill badge-success">выполнено</span>' : '<span class="badge badge-pill badge-danger">не выполнено</span>';
    status += r['is_edit'] == 1 ? '<br><span class="badge badge-pill badge-secondary">отредактировано администратором</span>' : '';

    return status;
}

$(function () {
    initTable();

    $('#modal-task-save').on('click', function (e) {
        e.preventDefault();

        let task = $('#modal-task-text').val(),
            index = $(this).data('index'),
            id = $(this).data('id'),
            oldValue = $(this).data('value'),
            data = {'type': 'EDIT', 'id': id, 'task': task};

        if(task == oldValue) {
            $('#modal-edit-task').modal('hide');
            showToast('Внимание', 'Задача не была изменена');
            return;
        }

        $.ajax({
            method: 'POST',
            url: 'admin.php',
            data: data
        })
            .done(function (newTask) {
                $('#modal-edit-task').modal('hide');

                if (newTask == 'access_denied') {
                    showToast('Внимание', 'Авторизация устарела. Обновите страницу и авторизуйтесь заново!');
                    return;
                }

                $table.bootstrapTable('updateCell', {
                    index: index,
                    field: 'task',
                    value: newTask
                });
                $table.bootstrapTable('updateCell', {
                    index: index,
                    field: 'is_edit',
                    value: 1
                });

                showToast('Успех', 'Данные обновлены');
            })
            .fail(function () {
                showToast('Ошибка', 'Проблема с обновлением данных!');
            });
    });

    $('#modal-status-save').on('click', function (e) {
        e.preventDefault();

        let is_done = $('#radio-status-done').prop('checked') ? 1 : 0,
            index = $(this).data('index'),
            id = $(this).data('id'),
            data = {'type': 'EDIT', 'id': id, 'is_done': is_done};

        $.ajax({
            method: 'POST',
            url: 'admin.php',
            data: data
        })
            .done(function (newStatus) {
                $('#modal-edit-status').modal('hide');

                if (newStatus == 'access_denied') {
                    showToast('Внимание', 'Авторизация устарела. Обновите страницу и авторизуйтесь заново!');
                    return;
                }

                $table.bootstrapTable('updateCell', {
                    index: index,
                    field: 'is_done',
                    value: newStatus
                });

                showToast('Успех', 'Данные обновлены');
            })
            .fail(function () {
                showToast('Ошибка', 'Проблема с обновлением данных!');
            });
    });

    $('#btn-exit').on('click', function (e) {
        e.preventDefault();

        let data = {'type': 'EXIT'};

        $.ajax({
            method: 'POST',
            url: 'admin.php',
            data: data
        })
            .done(function () {
                window.location.replace("index.php");
            })
            .fail(function () {
                showToast('Ошибка', 'Ошибка выхода из админки');
            });
    });
});