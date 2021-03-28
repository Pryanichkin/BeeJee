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
            locale: 'ru-RU'
        });
}

function doneFormatter(v) {
    return v == 1 ? '<span class="badge badge-pill badge-success">выполнено</span>' : '<span class="badge badge-pill badge-danger">не выполнено</span>';
}

$(function () {
    initTable();

    $('#form-login').on('submit', function (e) {
        e.preventDefault();

        let login = $('#user-login').val(),
            password = $('#user-pass').val(),
            form = $(this),
            data = {'type': 'LOGIN', 'login': login, 'password': password};

        $.ajax({
            method: 'POST',
            url: 'index.php',
            data: data
        })
            .done(function (isAdmin) {
                if (!isAdmin) {
                    form[0].reset();
                    $('.dropdown-toggle').dropdown('hide');
                    showToast('Ошибка', 'Неверный логин или пароль');
                } else {
                    window.location.replace("admin.php");
                }
            })
            .fail(function () {
                showToast('Ошибка', 'Неверный логин или пароль!');
            });
    });
});