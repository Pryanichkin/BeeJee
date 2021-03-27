$('#form-add-task').on('submit', function (e) {
    e.preventDefault();

    let userName = $('#user-name').val(),
        email = $('#email').val(),
        task = $('#task').val(),
        form = $(this),
        data = {'type': 'ADD', 'username': userName, 'email': email, 'task': task};

    $.ajax({
        method: 'POST',
        url: 'index.php',
        data: data
    })
        .done(function (dataDone) {
            form[0].reset();
            $('.dropdown-toggle').dropdown('hide');
            $table.bootstrapTable('append', JSON.parse(dataDone));
            showToast('Успех', 'Данные добавлены');
        })
        .fail(function () {
            showToast('Ошибка', 'Проблема с вносом данных!');
        });
});

function showToast(title, msg) {
    $('#toast-title').html(title);
    $('#toast-body').html(msg);
    $('#toast').toast('show');
}