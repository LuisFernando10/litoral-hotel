
    $('.js-promotion-btn-create').on('click', (e) => {

        //DOM
        let current_element = $(e.target);
        let element_name = $('.js-promotion-name');
        let element_room = $('.js-promotion-rooms');
        let element_price = $('.js-promotion-price');
        let element_initial_date = $('.js-promotion-initial-date');
        let element_final_date = $('.js-promotion-final-date');

        //Valores
        let value_name = element_name.val();
        let value_room = element_room.val();
        let value_price = element_price.val();
        let value_initial_date = element_initial_date.val();
        let value_final_date = element_final_date.val();

        //FormData
        let form_data = new FormData();

        form_data.append('promotion_name', value_name);
        form_data.append('promotion_room', value_room);
        form_data.append('promotion_price', value_price);
        form_data.append('promotion_initial_date', value_initial_date);
        form_data.append('promotion_final_date', value_final_date);
        form_data.append('action', 'INSERT');

        //Petición
        $.ajax({
            type: 'POST',
            url: `${FULL_WEB_URL}ajax/admin/promotion-crud.php`,
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
                    $(location).attr('href', FULL_WEB_URL + 'promocoes/')
                }
                else{
                    if (response.result === 'existing-promotion') notify_error_notification(response.message);
                    else notify_error_notification(response.message);

                    current_element.prop('disabled', false);
                    return false;
                }
            }
        });
    });

    $('.js-promotion-btn-edit').on('click', (e) => {

        //DOM
        let current_element = $(e.target);
        let element_name = $('.js-promotion-name');
        let element_room = $('.js-promotion-rooms');
        let element_price = $('.js-promotion-price');
        let element_initial_date = $('.js-promotion-initial-date');
        let element_final_date = $('.js-promotion-final-date');

        //Valores
        let value_id = current_element.attr('data-id');
        let value_name = element_name.val();
        let value_room = element_room.val();
        let value_price = element_price.val();
        let value_initial_date = element_initial_date.val();
        let value_final_date = element_final_date.val();

        //FormData
        let form_data = new FormData();

        form_data.append('promotion_id', value_id);
        form_data.append('promotion_name', value_name);
        form_data.append('promotion_room', value_room);
        form_data.append('promotion_price', value_price);
        form_data.append('promotion_initial_date', value_initial_date);
        form_data.append('promotion_final_date', value_final_date);
        form_data.append('action', 'UPDATE');

        //Ejecutamos Ajax
        $.ajax({
            type: 'POST',
            url: `${FULL_WEB_URL}ajax/admin/promotion-crud.php`,
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
                    $(location).attr('href', FULL_WEB_URL + 'promocoes/')
                }
                else{
                    if (response.result === 'existing-promotion') notify_error_notification(response.message);
                    else notify_error_notification(response.message);

                    current_element.prop('disabled', false);
                    return false;
                }
            }
        });
    });

    $('.js-promotion-btn-delete').on('click', (e) => {

        //DOM
        let current_element = $(e.target);
        let element_tr_parent = current_element.parents('tr.js-promotions-tr');

        //Valores
        let id_promotion = current_element.parents('tr.js-promotions-tr').attr('data-id');

        //Ajax
        $.ajax({
            type: 'POST',
            url: `${FULL_WEB_URL}ajax/admin/promotion-crud.php`,
            data: {
                promotion_id: id_promotion,
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