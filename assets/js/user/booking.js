
    //Variáveis ​​globais
    let CURRENT_DATE = new Date();
    let DATE_CHECK_IN = new Date(CURRENT_DATE.getFullYear(), CURRENT_DATE.getMonth(), CURRENT_DATE.getDate());
    let DATE_CHECK_OUT = new Date(CURRENT_DATE.getFullYear(), CURRENT_DATE.getMonth(), CURRENT_DATE.getDate()+1);
    let ROOMS = 1;
    let CHILDREN = 0;
    let TOTAL_PRICE = 0;

    //Obtemos os elementos do DOM
    let global_element_booking_check_in = $('.js-reserve-check-in');
    let global_element_booking_check_out = $('.js-reserve-check-out');
    let global_element_booking_children = $('.js-reserve-children');
    let global_element_booking_room = $('.js-reserve-room');
    let global_element_booking_type_room = $('.js-reserve-type_room');
    let global_element_booking_price = $('.js-booking-price');

    $(document).ready(function () {
        let property_price_option_selected = global_element_booking_type_room.find('option:selected').attr('data-room-price');
        global_element_booking_price.find('span').text(property_price_option_selected);

        //Chamamos método que valida um telefone válido (inicializacao)
        phone_validatios();
    })

    //Data de entrada
    global_element_booking_type_room.on('change', function() {
        calculate_price();
    });

    //Quarto
    global_element_booking_room.on('keyup', function () {
        if ($(this).val() !== '') ROOMS = $(this).val();
        calculate_price();
    });

    //Data de entrada
    global_element_booking_check_in.on('change', function() {

        DATE_CHECK_IN = $(this).val();

        if (validateIsGreaterDate(null, null, $(this).val(), DATE_CHECK_OUT) !== false)
            calculate_price();
    });

    //Data de saída
    global_element_booking_check_out.on('change', function() {

        DATE_CHECK_OUT = $(this).val();

        if (validateIsGreaterDate(null, null, DATE_CHECK_IN, $(this).val()) !== false)
            calculate_price();
    });

    //Evencto 'click' pro botao da reserva
    $('.js-btn-booking').on('click', function () {

        //Obtemos os valores
        let value_booking_check_in = global_element_booking_check_in.val();
        let value_booking_check_out = global_element_booking_check_out.val();
        let value_booking_children = global_element_booking_children.val();
        let value_booking_room = global_element_booking_room.val();
        let value_booking_type_room = global_element_booking_type_room.val();

        //Processo de validação
        if ((value_booking_check_in === '' || value_booking_check_in.length === 0) || (value_booking_check_out === '' || value_booking_check_out.length === 0)){
            notify_error_notification('As datas são obrigatórias.', 2000);
            return false;
        }
        else if (calculate_price() === false) return false;

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

        $(location).attr('href', `${FULL_WEB_URL}bookings/reserve/?check_in=${value_booking_check_in}&check_out=${value_booking_check_out}&children=${value_booking_children}&rooms=${value_booking_room}&price=${TOTAL_PRICE}&type_room=${value_booking_type_room}`)
    });

    $('.js-reserve-btn-send-email').on('click', function () {

        //Obtenemos los elementos del DOM
        let element_btn = $(this);
        let element_frm = $('.js-reserve-form');
        let element_name = element_frm.find('.js-reserve-name');
        let element_email = element_frm.find('.js-reserve-email');
        let element_phone = element_frm.find('.js-reserve-phone');
        let element_text = element_frm.find('.js-reserve-text');
        let element_check_in = $('.js-reserve-check-in');
        let element_check_out = $('.js-reserve-check-out');
        let element_diff_days = $('.js-reserve-diff-days');
        let element_type_room = $('.js-reserve-type-room');
        let element_room = $('.js-reserve-rooms');
        let element_adult = $('.js-reserve-adults');
        let element_children = $('.js-reserve-children');
        let element_price = $('.js-reserve-price');

        //Obtenemos los valores
        let value_name = element_name.val();
        let value_email = element_email.val();
        let value_phone = element_phone.val();
        let value_text = element_text.val();
        let value_check_in = element_check_in.text();
        let value_check_out = element_check_out.text();
        let value_diff_days = element_diff_days.text();
        let value_type_room = element_type_room.attr('data-id-room');
        let value_room = element_room.text();
        let value_adult = element_adult.text();
        let value_children = element_children.text();
        let value_price = element_price.text();

        //** Proceso para validar los datos **

        //Variable de control
        var control_validation = false;

        if (value_name === '' || value_name.length === 0){
            notify_error_notification('O <b>Nome</b> é obrigatório.', 2000);
            return false;
        }
        else if (value_email === '' || value_email.length === 0){
            notify_error_notification('O <b>Email</b> é obrigatório.', 2000);
            return false;
        }
        else if ((value_email !== '' || value_email.length > 0) && validateEmail(value_email) === false){
            notify_error_notification('O <b>Email</b> é inválido.', 2000);
            return false;
        }
        else if (value_phone.length > 0 && value_phone.length <= 5){
            notify_error_notification('O <b>Telefone</b> deve ter mais de 5 dígitos.', 2000);
            return false;
        }
        else if ((value_phone.length > 5 && value_phone.length < 32) && validatePhoneNumber(value_phone) === false){
            notify_error_notification('Por favor insira um <b>Telefone</b> válido. Ex: (+55)7999882442', 2000);
            return false;
        }
        else if (value_text === '' || value_text.length === 0){
            notify_error_notification('A <b>Mensagem</b> é obrigatória.', 2000);
            return false;
        }
        else control_validation = true;

        //Validamos si t0do etá Ok
        if (control_validation === true)
            $.ajax({
                type : 'POST',
                url : FULL_WEB_URL+'ajax/scripts/send-email.php',
                data : {
                    name : value_name,
                    email : value_email,
                    phone : value_phone,
                    text : value_text,
                    check_in : value_check_in,
                    check_out : value_check_out,
                    diff_days : value_diff_days,
                    type_room : value_type_room,
                    room : value_room,
                    adult : value_adult,
                    children : value_children,
                    price : value_price,
                    action: 'RESERVE'
                },
                beforeSend: function(){
                    //element_btn
                    //    .prop('disabled', true)
                    //    .addClass('css-cursor-not-allowed');
                },
                success : function (response) {

                    //Parseamos la respuesta a formato JSON
                    let json_object = $.parseJSON(response);

                    //Validamos si hubo o no éxito
                    if (json_object.status === '200'){
                        notify_success_notification(json_object.message);
                        setTimeout(function (){
                            //location.attr('href', `${FULL_WEB_URL}`);
                        }, 3000);
                    }
                    else{
                        if(json_object.type === 'INSERT-RESERVE'){
                            notify_error_notification(json_object.message);
                            setTimeout(function (){
                                location.attr('href', `${FULL_WEB_URL}`);
                            }, 3000);
                            return false;
                        }
                        else{
                            notify_error_notification(json_object.message);
                            return false;
                        }
                    }
                },
                complete: function () {
                    //element_btn
                    //    .prop('disabled', false)
                    //    .removeClass('css-cursor-not-allowed');

                    //Limpiamos los valores
                    //element_name.val('');
                    //element_email.val('');
                    //element_phone.val('');
                    //element_text.val('');
                }
            });

        return false;
    });

    /**
     * @Description: Método que faz o cálculo dos dados para obter o preco final
     */
    function calculate_price(){

        //Obtemos os elementos do DOM
        let element_booking_price = global_element_booking_price.find('span');

        //Fazemos o cálculo da diferenca dos dias e obtemos outros valores
        let check_in = new Date(DATE_CHECK_IN).getTime();
        let check_out = new Date(DATE_CHECK_OUT).getTime();
        let difference_date = check_out - check_in;
        let days_difference_millisecond = (difference_date / (1000*60*60*24)).toFixed();
        let room_price = global_element_booking_type_room.find('option:selected').attr('data-room-price');
        let total_price = 0;

        if (days_difference_millisecond === '0'){
            notify_error_notification('Você não pode selecionar o mesmo dia da Data de Chegada.');
            return false;
        }
        else
            //Obtemos o total do preco com as datas escolhidas
            total_price = ((room_price * days_difference_millisecond) * ROOMS);

        //A gente formatea o numero
        //total_price = number_format_js(total_price,2,'.',',');

        //Mudamos o valor do preco
        //element_booking_price.text(addOrRemoveDecimalsToAffiliateValue(total_price));
        element_booking_price.text(total_price);

        //Atualizamos a variável
        TOTAL_PRICE = total_price;
    }