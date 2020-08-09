
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