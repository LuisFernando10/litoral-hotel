
    //Inicializacao do método pras datas
    setting_datepicker();

    /**
     * @Description: Método que tem as configuracoes das 'datas' pra reservas
     */
    function setting_datepicker() {

        var current_date = new Date();

        //Data de entrada
        $(".js-reserve-check-in").datepicker({
            defaultDate: current_date,
            dateFormat: 'yy-mm-dd',
            minDate: current_date,
            onClose: function (selectedDate) {
                $(".js-reserve-check-out").datepicker("option", "minDate", selectedDate);
            }
        });

        //Data de saída
        $(".js-reserve-check-out").datepicker({
            dateFormat: 'yy-mm-dd',
            minDate: current_date,
            maxDate: new Date(current_date.getFullYear(), current_date.getMonth()+2, current_date.getDate()),
            onClose: function (selectedDate) {
                $(".js-reserve-check-in").datepicker("option", "maxDate", selectedDate);
            }
        });
    }

    /**
     * @Description: Método que valida um telefone válido
     */
    function phone_validatios(){
        $('.js-input-number').on('input', function () {
            this.value = this.value.replace(/[^0-9()-. ]/g,'');
        });
    }

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

    /**
     * @Description: Método pra validar um email
     */
    function validateEmail(email) {
        let regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        return regex.test(email);
    }

    /**
     * @Description: Método pra validar um número
     */
    function validateNumber(number) {
        let regExp = /^([0-9])*$/;
        return regExp.test(number);
    }

    /**
     * @Description: Método que valida se uma data é maior que outra
     */
    function validateIsGreaterDate(element_initial_date = null, element_final_date = null, initial_date, final_date) {

        if (Date.parse(initial_date) > Date.parse(final_date)){
            notify_error_notification('A "Data de Chegada" deve ser menor que a "Data de Saída".');
            return false;
        }
    }

    /**
     * @Description: Método que valida a informacao preenchida no form das datas pra solocitar a reserva
     */
    function validateReserveFields() {

        //Obtemos os elementos do DOM
        let global_element_booking_check_in = $('.js-reserve-check-in');
        let global_element_booking_check_out = $('.js-reserve-check-out');
        let global_element_booking_children = $('.js-reserve-children');
        let global_element_booking_room = $('.js-reserve-room');

        //Obtemos os valores
        let value_booking_check_in = global_element_booking_check_in.val();
        let value_booking_check_out = global_element_booking_check_out.val();
        let value_booking_children = global_element_booking_children.val();
        let value_booking_room = global_element_booking_room.val();

        //Processo de validação
        if ((value_booking_check_in === '' || value_booking_check_in.length === 0) || (value_booking_check_out === '' || value_booking_check_out.length === 0)){
            notify_error_notification('As datas são obrigatórias.', 2000);
            return false;
        }

        if (value_booking_children.length > 1 || validateNumber(value_booking_children) === false || isNaN(value_booking_children) === true){
            notify_error_notification('Somente números são aceitos.', 2000);
            return false;
        }

        if (value_booking_room === '' || value_booking_room.length === 0){
            notify_error_notification('O número de quartos é obrigatório.', 2000);
            return false;
        }
        else if (value_booking_room.length > 1 || validateNumber(value_booking_room) === false || isNaN(value_booking_room) === true){
            notify_error_notification('Somente números são aceitos.', 2000);
            return false;
        }

        return true;
    }