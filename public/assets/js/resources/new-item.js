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

    document.getElementById('newItem').addEventListener('click', function () {
        const button = this;
        const text = button.querySelector('.button-text');
        const spinner = button.querySelector('.spinner-border');
        const form = document.getElementById('condosForm');

        const name = document.getElementById('name').value;
        const quantity = document.getElementById('quantity').value;

        if (name == ''){
            message = 'Preencha corretamente o nome do item';
            playNotif(message);
        }else if(quantity == ''){
            message = 'Insira a quantidade deste item em estoque';
            playNotif(message);
        }else{
            text.classList.add('d-none');
            spinner.classList.remove('d-none');
            form.submit();
        }
    });
});
