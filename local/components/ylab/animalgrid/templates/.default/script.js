BX.ready(function () {
    document.querySelectorAll('.js-action').forEach(function (button) {
        button.addEventListener('click', function () {
            let action = button.dataset['action'];

            BX.ajax.runComponentAction('ylab:animalgrid', action, {
                mode: 'class', //это означает, что мы хотим вызывать действие из class.php
                data: {
                    format: 'j F Y', //данные будут автоматически замаплены на параметры метода 
                },
            }).then(function (response) {
                console.log('success');
                console.log(response);

                document.querySelector('.js-time-container').innerHTML = response.data;
            }, function (response) {

                console.log('error');
                console.log(response);
            });
        });
    })
});