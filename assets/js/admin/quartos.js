
    $('.btn-quartos-save').on('click', function () {

        //Obtenemos los elementos
        let element_name = $('.js-quarto-nome');
        let element_description = $('.js-quarto-descricao');
        let element_adultos = $('.js-quartos-adultos');
        let element_price = $('.js-quarto-preco');
        let element_image = $('.js-quarto-image');

        //Obtenemos los valores
        let value_name = element_name.val();
        let value_description = element_description.val();
        let value_adultos = element_adultos.val();
        let value_price = element_price.val();
        let value_image = element_image.prop('files')[0];

        //Creamos objeto para recopilar los datos que enviaremos al Ajax
        let form_data = new FormData();

        //Adicionamos las llaves y los valores que conformarán el FormData
        form_data.append('quarto_name', value_name);
        form_data.append('quarto_description', value_description);
        form_data.append('quarto_adultos', value_adultos);
        form_data.append('quarto_price', value_price);
        form_data.append('quarto_file', value_image);
        form_data.append('action', 'INSERT');

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
                    $(location).attr('href', FULL_WEB_URL + 'quartos/')
                }
                else
                    notify_error_notification(response.message);
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

    // ** Codigo para permitir funcionalidade ao <file-input> do modelo **

    //Pra detectar o clique e acionar o 'input-file'
    $('.form-file-simple .inputFileVisible, .js-icon-open-input-file').click(function() {
        $(this).siblings('.inputFileHidden').trigger('click');
    });

    //Para exibir o nome do arquivo selecionado no 'input'
    $('.form-file-simple .inputFileHidden').change(function() {
        var filename = $(this).val().replace(/C:\\fakepath\\/i, '');
        $(this).siblings('.inputFileVisible').val(filename);
    });