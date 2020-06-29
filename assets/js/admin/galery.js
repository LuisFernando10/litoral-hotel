
    $('.btn-galery-save').on('click', function () {

        //Obtenemos los elementos
        let element_name = $('.js-galery-nome');
        let element_tipo = $('.js-galery-tipo');
        let element_description = $('.js-galery-descricao');
        let element_image = $('.js-galery-image');

        //Obtenemos los valores
        let value_name = element_name.val();
        let value_tipo = element_tipo.val();
        let value_description = element_description.val();
        let value_image = element_image.prop('files')[0];

        //Creamos objeto para recopilar los datos que enviaremos al Ajax
        let form_data = new FormData();

        //Adicionamos las llaves y los valores que conformarán el FormData
        form_data.append('galery_name', value_name);
        form_data.append('galery_tipo', value_tipo);
        form_data.append('galery_description', value_description);
        form_data.append('galery_file', value_image);
        form_data.append('action', 'INSERT');

        //Ejecutamos Ajax
        $.ajax({
            type: 'POST',
            url: FULL_WEB_URL+'ajax/admin/galery-crud.php',
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
                    $(location).attr('href', FULL_WEB_URL + 'galeria/')
                }
                else
                    notify_error_notification(response.message);
            }
        });
    });

    $('.btn-galery-save-edit').on('click', function () {

        //Obtenemos los elementos
        let element_frm_parent = $('.js-galery-frm-edit');
        let element_name = element_frm_parent.find('.js-galery-nome');
        let element_tipo = element_frm_parent.find('.js-galery-tipo');
        let element_description = element_frm_parent.find('.js-galery-descricao');
        let element_image = element_frm_parent.find('.js-galery-image');

        //Obtenemos los valores
        let value_name = element_name.val();
        let value_tipo = element_tipo.val();
        let value_description = element_description.val();
        let value_image = element_image.prop('files')[0];

        //Creamos objeto para recopilar los datos que enviaremos al Ajax
        let form_data = new FormData();

        //Adicionamos las llaves y los valores que conformarán el FormData
        form_data.append('galery_id', $(this).attr('data-id'));
        form_data.append('galery_name', value_name);
        form_data.append('galery_tipo', value_tipo);
        form_data.append('galery_description', value_description);
        form_data.append('galery_file', value_image);
        form_data.append('galery_file_current_name', $('.js-input-file-edit').val());
        form_data.append('action', 'UPDATE');

        //Ejecutamos Ajax
        $.ajax({
            type: 'POST',
            url: FULL_WEB_URL+'ajax/admin/galery-crud.php',
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
                    $(location).attr('href', FULL_WEB_URL + 'galeria/');
                }
                else
                    notify_error_notification(response.message);
            }
        });
    });

    $('.js-galery-btn-delete').on('click', function () {

        //Nos os elementos do DOM
        let element_tr_parent = $(this).parents('tr.js-galery-tr');

        //Nós obtemos o Id do galery pra deletar
        let id_galery = $(this).attr('data-id');

        //Executamos a peticao  Ajax
        $.ajax({
            type: 'POST',
            url: FULL_WEB_URL+'ajax/admin/galery-crud.php',
            data: {
                galery_id: id_galery,
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