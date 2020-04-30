
    $(document).ready(function () {
        //Métodos executados por defeito no carregamento do documento
        configurations_function();
    });

    //Evento 'click' pra adicionar uma nova configuracao ao container
    $('.js-btn-configuracao-add-telefones').on('click', function () {

        //Obtemos o HTML oculto
        let element_hide_parent_container = $('.js-hide-container-to-add-phones');

        //Adicionamos o HTML ao elemento principal
        $('.js-real-container-to-add-phones').append(element_hide_parent_container.html());

        //Método que procesa sub-procesos
        configurations_function();
    });

    //Evento 'click' pra processar os dados e guardar no BD
    $('.js-btn-configuracao-salvar').on('click', function () {

        //Obtemos os elementos do DOM
        let element_general_container = $('.js-form-data-real-container');
        let element_neighborhood = element_general_container.find('.js-configuracao-barrio');
        let element_state = element_general_container.find('.js-configuracao-estado');
        let element_country = element_general_container.find('.js-configuracao-pais');
        let element_phones = element_general_container.find('.js-real-container-to-add-phones');

        //Obtemos os valores
        let value_neighborhood = element_neighborhood.val();
        let value_state = element_state.val();
        let value_country = element_country.val();

        // ** Processo pra obter os telefones

        //Criamos variavél pra guardar os telefones adicionados dinámicacmente
        var array_phone = [];

        //Iteramos sob os telefones adicionados
        element_phones.find('.js-div-new-row').each(function () {

            //Criamos objeto pra guardar o 'telefone' e o 'tipo'
            let object_data_phone = {};

            //Obtemos os elementos do DOM
            let element_phone_number = $(this).find('.js-configuracao-telefone');
            let element_phone_type = $(this).find('.js-configuracao-tipo');

            //Obtemos os valores
            let value_phone_number = element_phone_number.val();
            let value_phone_type = element_phone_type.val();

            //Alimentamos o objeto com os valores
            object_data_phone['telefone'] = value_phone_number;
            object_data_phone['tipo'] = value_phone_type;

            //Alimentamos o array geral
            array_phone.push(object_data_phone);
        });

        //Processamos a peticao Ajax pra mandar os dados ao BD
        $.ajax({
            type: 'POST',
            url: FULL_WEB_URL + 'ajax/admin/configurations-crud.php',
            data:{
                array_data: array_phone,
                neighborhood: value_neighborhood,
                state: value_state,
                country: value_country,
                action: 'INSERT'
            },
            success: function (response) {

                //Passamos a resposta para JSON
                let json_obj = $.parseJSON(response);

                console.log(json_obj);
            }
        });

    });

    /**
     * @Description: Método que executa sub-métodos pra funcionalidade dependentes de outros procesos
     */
    function configurations_function() {

        //Obtemos os elementos do DOM
        let element_btn_delete = $('.js-real-container-to-add-phones .js-btn-configuration-phone-delete');

        //Refrescamos os evntos dos elementos
        element_btn_delete.off('click');

        //DELETAR um oferecimento
        element_btn_delete.on('click', function () {
            delete_phone($(this));
        });
    }

    /**
     * @Description: Método que deleta o 'oferecimento' do HTML
     */
    function delete_phone(element) {

        //Deletamos o HTML do telepone
        element
            .parents('.js-div-new-row')
            .hide('slow')
            .remove()
            .removeClass('js-div-new-row');
    }