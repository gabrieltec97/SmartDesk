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

    document.getElementById('newCondo').addEventListener('click', function () {
        const button = this;
        const text = button.querySelector('.button-text');
        const spinner = button.querySelector('.spinner-border');
        const form = document.getElementById('condosForm');

        const name = document.getElementById('name').value;
        const city = document.getElementById('city').value;

        if (name == ''){
            message = 'Preencha corretamente o nome do condomínio';
            playNotif(message);
        }else if(city == ''){
            message = 'Preencha corretamente a cidade do condomínio';
            playNotif(message);
        }else{
            // text.classList.add('d-none');
            // spinner.classList.remove('d-none');
            form.submit();
        }
    });
});
