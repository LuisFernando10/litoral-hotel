
    /**
     * @Description: Método para notificación de 'Exito'
     */
    function notify_success_notification(message){

        $.notify({
            icon: "nc-icon nc-check-2",
            message: message
        },{
            type: 'success',
            timer: 8000,
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
            icon: "nc-icon nc-simple-remove",
            message: message
        },{
            type: 'danger',
            timer: 8000,
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