
    $('.js-holiday-btn-save').on('click', (e) => {

        //DOM
        const current_element = $(e.target);
        const element_name = $('.js-holiday-name');
        const element_initial_date = $('.js-holiday-initial-date');
        const element_final_date = $('.js-holiday-final-date');
        const element_parent_div_rooms = $('.js-div-room-images .js-parent-room-images');

        //Valores
        const value_name = element_name.val();
        const value_initial_date = element_initial_date.val();
        const value_final_date = element_final_date.val();
        const type_action = current_element.attr('data-type');
        const id_holiday = type_action === 'ADD' ? '' : $('div[data-holiday-id]').attr('data-holiday-id');

        //Generales
        let form_data = new FormData();
        let array_data = [];
        let control_validation = true;

        element_parent_div_rooms.each( (idx, elem) => {

            const general_object = {};
            const element_card = $(elem).find('div[data-id-room]');
            const element_input = $(elem).find('input.js-holiday-room-price');

            if ( element_card.attr('data-id-room') !== '' && element_input.val() !== '' ){

                if ( type_action === 'EDIT' ) general_object['id_quarto_feriado'] = element_card.attr('data-id-room-hoiday');

                general_object['id_quarto'] = element_card.attr('data-id-room');
                general_object['preco'] = element_input.val();

                array_data.push(general_object);
            }
            else control_validation = false;
        });

        // Validaciones
        if ( value_name === '' ){
            notify_error_notification('Por favor insira o nome.');
            return false;
        }
        else if ( value_initial_date === '' || value_final_date === '' ){
            notify_error_notification('Por favor insira as datas.');
            return false;
        }
        else if ( !control_validation ){
            notify_error_notification('Por favor insira um preço para os quartos.');
            return false;
        }
        else if ( array_data.length === 0 ){
            notify_error_notification('Por favor insira os preços para os quartos.');
            return false;
        }
        else {
            form_data.append('holiday_id', id_holiday);
            form_data.append('holiday_name', value_name);
            form_data.append('holiday_initial_date', value_initial_date);
            form_data.append('holiday_final_date', value_final_date);
            form_data.append('array_data', JSON.stringify(array_data));
            form_data.append('action', type_action === 'ADD' ? 'INSERT' : 'UPDATE');

            //Petición
            $.ajax({
                type: 'POST',
                url: `${FULL_WEB_URL}ajax/admin/holiday-crud.php`,
                dataType: 'json',
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,
                beforeSend: () => {
                    current_element.prop('disabled', true);
                },
                success: function (response) {
                    if (response.status === '200'){
                        notify_success_notification(response.message);
                        $(location).attr('href', FULL_WEB_URL + 'feriados/')
                    }
                    else{
                        if (response.result === 'existing-holiday') notify_error_notification(response.message);
                        else notify_error_notification(response.message);

                        current_element.prop('disabled', false);
                        return false;
                    }
                }
            });
        }
    });

    $('.js-holiday-btn-delete').on('click', (e) => {

        //DOM
        let current_element = $(e.target);
        let element_tr_parent = current_element.parents('tr.js-holiday-tr');

        //Valores
        let id_holiday = current_element.parents('tr.js-holiday-tr').attr('data-id');

        //Ajax
        $.ajax({
            type: 'POST',
            url: `${FULL_WEB_URL}ajax/admin/holiday-crud.php`,
            data: {
                holiday_id: id_holiday,
                action: 'DELETE'
            },
            success: function (response) {
                let obj_json = $.parseJSON(response);

                if (obj_json.status === '200'){
                    notify_success_notification(obj_json.message);
                    element_tr_parent.hide('slow', function(){ element_tr_parent.remove(); });
                }
                else notify_error_notification(obj_json.message);
            }
        });
    });