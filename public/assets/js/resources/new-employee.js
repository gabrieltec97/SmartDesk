document.addEventListener('DOMContentLoaded', function () {
    function playNotif(message){
        const notyf = new Notyf({
            position: {
                x: 'right',
                y: 'top',
            }
        });

        notyf
            .error({
                message: message,
                dismissible: true,
                duration: 5000
            })
    }

    document.getElementById('register').addEventListener('click', function () {
        const form = document.getElementById('user-form');
        const button = this;

        employee(form, button);
    });

    document.getElementById('save').addEventListener('click', function () {
        const formEdit = document.getElementById('edit-form');
        const buttonEdit = this;

        employee(formEdit, buttonEdit);
    });

    function employee(form, button){

        const text = button.querySelector('.button-text');
        const spinner = button.querySelector('.spinner-border');

        const name = document.getElementById('name').value;
        const sector = document.getElementById('sector').value;

        if (name == ''){
            message = 'Preencha corretamente o nome e sobrenome';
            playNotif(message);
        }else if(sector == 'selecione'){
            message = 'Escolha um sector para este usuário';
            playNotif(message);
        }else{
            text.classList.add('d-none');
            spinner.classList.remove('d-none');
            form.submit();
        }
    }
});
