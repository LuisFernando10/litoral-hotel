
    $(document).ready(function () {

    });

    //Obtemos os elementos do DOM
    let element_booking_check_in = $('.js-reserve-check-in');
    let element_booking_check_out = $('.js-reserve-check-out');
    let element_booking_children = $('.js-reserve-children');
    let element_booking_room = $('.js-reserve-room');
    let element_booking_price = $('.js-booking-price');

    $('.js-btn-booking').on('click', function () {

        //Obtemos os valores
        let value_booking_check_in = element_booking_check_in.val();
        let value_booking_check_out = element_booking_check_out.val();
        let value_booking_children = element_booking_children.val();
        let value_booking_room = element_booking_room.val();
        let value_booking_price = element_booking_price.text();

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

        $(location).attr('href', `${FULL_WEB_URL}bookings/reserve/?check_in=${value_booking_check_in}&check_out=${value_booking_check_out}&children=${value_booking_children}&room=${value_booking_room}&price=${value_booking_price}`)

    });