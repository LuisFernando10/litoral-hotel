
    //Inicializacao do método pras datas
    setting_datepicker();

    $('.js-btn-reserve').on('click', function () {

        //Elementos DOM
        let element_form = $('.js-frm-reserve-data');

        //Validamos se as validacoes estao certas
        if (validateReserveFields()) element_form.submit();

        return false;
    });

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
        else if (value_booking_check_in === value_booking_check_out){
            notify_error_notification('As datas não podem ser as mesmas.', 2000);
            return false;
        }
        else if (validateIsGreaterDate(null, null, value_booking_check_in, value_booking_check_out) === false)
            return false;

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