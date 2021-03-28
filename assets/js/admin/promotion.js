
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
            url: FULL_WEB_URL+'ajax/admin/promotion-crud.php',
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

    $('.btn-quartos-save-edit').on('click', function () {

        //Obtenemos los elementos
        let element_frm_parent = $('.js-quarto-frm-edit');
        let element_name = element_frm_parent.find('.js-quarto-nome');
        let element_description = element_frm_parent.find('.js-quarto-descricao');
        let element_adultos = element_frm_parent.find('.js-quarto-adultos');
        let element_price = element_frm_parent.find('.js-quarto-preco');
        let element_image = element_frm_parent.find('.js-quarto-image');
        let element_estado = element_frm_parent.find('.js-quarto-estado');

        //Obtenemos los valores
        let value_name = element_name.val();
        let value_description = element_description.val();
        let value_adultos = element_adultos.val();
        let value_price = element_price.val();
        let value_image = element_image.prop('files')[0];
        let value_estado = element_estado.val();

        //Creamos objeto para recopilar los datos que enviaremos al Ajax
        let form_data = new FormData();

        //Adicionamos las llaves y los valores que conformarán el FormData
        form_data.append('quarto_id', $(this).attr('data-id'));
        form_data.append('quarto_name', value_name);
        form_data.append('quarto_description', value_description);
        form_data.append('quarto_adultos', value_adultos);
        form_data.append('quarto_price', value_price);
        form_data.append('quarto_file', value_image);
        form_data.append('quarto_file_current_name', $('.js-input-file-edit').val());
        form_data.append('quarto_estado', value_estado);
        form_data.append('action', 'UPDATE');

        //Ejecutamos Ajax
        $.ajax({
            type: 'POST',
            url: FULL_WEB_URL+'ajax/admin/quartos-crud.php',
            dataType: 'json',
            cache: false,
            contentType: false,
            processData: false,
            data: form_data,
            success: function (response) {

                //Nos validamos o estado da petiçao
                if (response.status === '200'){

                    //Mensagem de sucesso
                    notify_success_notification(response.message);

                    //Direitonamos pra a pagina do list
                    $(location).attr('href', FULL_WEB_URL + 'quartos/');
                }
                else
                    notify_error_notification(response.message);
            }
        });
    });

    $('.js-quarto-btn-delete').on('click', function () {

        //Nos os elementos do DOM
        let element_tr_parent = $(this).parents('tr.js-quartos-tr');

        //Nós obtemos o Id do quarto pra deletar
        let id_room = $(this).attr('data-id');

        //Executamos a peticao  Ajax
        $.ajax({
            type: 'POST',
            url: FULL_WEB_URL+'ajax/admin/quartos-crud.php',
            data: {
                quarto_id: id_room,
                action: 'DELETE'
            },
            success: function (response) {

                //Nos vamos analisar o formato json a resposta
                let obj_json = $.parseJSON(response);

                //Nos validamos o estado da petiçao
                if (obj_json.status === '200'){

                    //Mensagem de sucesso
                    notify_success_notification(obj_json.message);

                    //Removemos com animacao a linha da tabela
                    element_tr_parent.hide('slow', function(){ element_tr_parent.remove(); });
                }
                else
                    notify_error_notification(obj_json.message);
            }
        });
    });