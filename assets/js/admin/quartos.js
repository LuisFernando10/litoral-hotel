
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
                    notify_success_notification(response.message);
                }
                else
                    notify_error_notification(response.message);
            }
        });
    });