
    //Variáveis globales
    var status_ok = false; //Controla quando um processo foi com sucesso ou nao

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
    $('.js-btn-configuracao-salvar, .js-btn-configuracao-alterar').on('click', function () {

        //Obtemos os elementos do DOM
        let element_btn = $(this);

        //Evaluamos que tipo de botao é pra executar a respetiva peticao ajax
        if (element_btn.attr('data-btn-type') === 'salvar')
            ajax_petition('INSERT', element_btn);
        else
            ajax_petition('UPDATE', element_btn);
    });

    /**
     * @Description: Método que procesa as peticoes Ajax
     */
    function ajax_petition(action, element_btn) {

        //Obtemos os elementos do DOM
        let element_general_container = $('.js-form-data-real-container');
        let element_neighborhood = element_general_container.find('.js-configuracao-barrio');
        let element_state = element_general_container.find('.js-configuracao-estado');
        let element_country = element_general_container.find('.js-configuracao-pais');
        let element_phones = element_general_container.find('.js-real-container-to-add-phones');
        let element_id_configuration = $('.js-input-hidden-control-id');

        //Obtemos os valores
        let value_neighborhood = element_neighborhood.val();
        let value_state = element_state.val();
        let value_country = element_country.val();

        // ** Processo pra validacao dos campos **

        //Definimos variável de control para as validacoes
        var control_validity = true;

        if (validateFullString(element_neighborhood) === false
            || validateFullString(element_state) === false
            || validateFullString(element_country) === false){
            control_validity = false;
            return false;
        }

        // ** Processo pra obter os telefones **

        //Criamos variavél pra guardar os telefones adicionados dinámicacmente
        var array_phone = [];

        //Iteramos sob os telefones adicionados
        element_phones.find('.js-div-new-row').each(function (index, value) {

            //Criamos objeto pra guardar o 'telefone' e o 'tipo'
            let object_data_phone = {};

            //Obtemos os elementos do DOM
            let element_phone_number = $(this).find('.js-configuracao-telefone');
            let element_phone_type = $(this).find('.js-configuracao-tipo');

            //Obtemos os valores
            let value_phone_number = element_phone_number.val();
            let value_phone_type = element_phone_type.val();

            // ** Validamos se o número de telefone já existe **
            let phone_validation = array_phone.find( phone => phone.telefone === value_phone_number );

            if (value_phone_number === '' || value_phone_number.length === 0){

                //Disparamos aviso de erro
                //markErrorBorder(element_phone_number, `O número ${value_phone_number} já existe.`);
                markErrorBorder(element_phone_number, 'Você não pode ter telefones vazios.');
                control_validity = false;
                return false;
            }
            else if (phone_validation !== undefined){
                //Disparamos aviso de erro
                markErrorBorder(element_phone_number, `O número ${value_phone_number} já existe.`);
                control_validity = false;
                return false;
            }
            else{
                //Alimentamos o objeto com os valores
                object_data_phone['telefone'] = value_phone_number;
                object_data_phone['tipo'] = value_phone_type;
            }

            //Alimentamos o array geral
            array_phone.push(object_data_phone);
        });

        //Validamos se as validacoes foram 'Ok'
        if (control_validity === true)
            //Processamos a peticao Ajax pra mandar os dados ao BD
            $.ajax({
                type: 'POST',
                url: FULL_WEB_URL + 'ajax/admin/configurations-crud.php',
                data:{
                    array_data: array_phone,
                    neighborhood: value_neighborhood,
                    state: value_state,
                    country: value_country,
                    id_configuration: element_id_configuration.attr('data-id'),
                    action: action
                },
                beforeSend: function(){
                    enable_disable_elements(element_btn, 'disabled');
                },
                success: function (response) {

                    //Passamos a resposta para JSON
                    let json_obj = $.parseJSON(response);

                    //Validamos se a operacao tuvo sucesso
                    if (json_obj.status === '200'){

                        //Validamos se é de tipo 'INSERT' pra carregar o Id da edicao
                        if (action === 'INSERT')
                            element_id_configuration.attr('data-id', json_obj.id_configuracao);

                        //Notificacao de sucesso
                        notify_success_notification(json_obj.message, 2500);

                        //Atualizamos o valor da variavel global
                        status_ok = true;
                    }
                    else{
                        notify_error_notification(json_obj.message);
                        enable_disable_elements(element_btn, 'enabled');
                        return false;
                    }
                },
                complete: function(){

                    //Validamos o estado da variavel global
                    if (status_ok === true){
                        setTimeout(function () {
                            location.reload();
                            enable_disable_elements(element_btn, 'enabled');
                            status_ok = false;
                        }, 3000);
                    }
                },
            });
        else
            return false;
    }

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
    
    /**
     *@Description: Método que ativa/desativa um elemento HTML do DOM
     */
    function enable_disable_elements(element, type) {

        //Validamos o tipo de acao
        if (type === 'enabled'){
            element
                .prop('disabled', false)
                .removeClass('css-cursor-not-allowed');
        }
        else
            element
                .prop('disabled', true)
                .addClass('css-cursor-not-allowed');
    }