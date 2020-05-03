
    $('.js-input-number').on('input', function () {
        this.value = this.value.replace(/[^0-9]/g,'');
    });

    /**
     * @Description: Método para notificación de 'Exito'
     */
    function notify_success_notification(message, time = 4000){

        $.notify({
            icon: '<i class="material-icons text-white">check_circle</i>',
            message: message
        },{
            type: 'success',
            timer: time,
            placement: {
                from: 'top',
                align: 'right'
            }
        });
    }

    /**
     * @Description: Método para notificación de 'Error'
     */
    function notify_error_notification(message, time = 4000){

        $.notify({
            icon: '<i class="material-icons text-white">error</i>',
            message: message
        },{
            type: 'danger',
            timer: 4000,
            placement: {
                from: 'top',
                align: 'right'
            }
        });
    }

    /**
     * @Description: Método para notificación de 'Advertencia'
     */
    function notify_warning_notification(message, time = 4000){

        $.notify({
            icon: '<i class="material-icons text-white">warning</i>',
            message: message
        },{
            type: 'warning',
            timer: 4000,
            placement: {
                from: 'top',
                align: 'right'
            }
        });
    }

    /**
     * @Description: Método para validar texto com todos os caracteres
     */
    function validateFullString(index, length = 128, message = 'Este campo é obrigatório.') {

        let value = index.val();

        if (value === null || value === "" || value.length === 0){

            index.addClass('border-bottom border-danger');
            notify_warning_notification(message);
            return false;
        }
        else if (value.length > length){
            index.addClass('border-bottom border-danger');
            notify_warning_notification(message);
            return false;
        }
        else{
            index.removeClass('border-bottom border-danger');
            return true;
        }
    }

    /**
     * @Description: Método para marcar o borde de cor vermelho quando um processo errou
     */
    function markErrorBorder(index, message = 'Ocorreu um erro.') {

        index.addClass('border-bottom border-danger');
        notify_warning_notification(message);
        return false;
    }