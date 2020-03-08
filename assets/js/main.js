
    /**
     * @Description: Método para notificación de 'Exito'
     */
    function notify_success_notification(message){

        $.notify({
            icon: '<i class="material-icons text-white">check_circle</i>',
            message: message
        },{
            type: 'success',
            timer: 4000,
            placement: {
                from: 'top',
                align: 'right'
            }
        });
    }

    /**
     * @Description: Método para notificación de 'Error'
     */
    function notify_error_notification(message){

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

    function  validateString(index) {

        let value = index.val();

        if (value === null || value === ""){

            index.addClass('border-danger');
            return false;
        }
        else{
            index.removeClass('border-danger');
            return true;
        }
    }