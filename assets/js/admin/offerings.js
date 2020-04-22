
    $(document).ready(function () {
        //Métodos executados por defeito no carregamento do documento
        offering_function();
        offering_priorities();
    });

    //Evento 'click' pra adicionar um novo oferecimento ao container
    $('.js-btn-offering-add-fields').on('click', function () {

        //Obtemos o HTML oculto
        let element_hide_parent_container = $('.js-hide-parent-div-add-elements');

        //Adicionamos o HTML ao elemento principal
        $('.js-container-to-add-elements').append(element_hide_parent_container.html());

        //Método que procesa sub-procesos
        offering_function();

        //Método que ordena as prioridades
        offering_priorities();
    });

    /**
     * @Description: Método que executa sub-métodos pra funcionalidade dependentes de outros procesos
     */
    function offering_function() {

        //Obtemos os elementos do DOM
        let element_btn_delete = $('.js-container-to-add-elements .js-btn-offering-priority-delete');
        let element_btn_up = $('.js-container-to-add-elements .js-btn-offering-priority-up');
        let element_btn_down = $('.js-container-to-add-elements .js-btn-offering-priority-down');
        let element_offering_name = $('.js-container-to-add-elements .js-offering-field-name');
        let element_offering_type = $('.js-container-to-add-elements .js-offering-field-type');

        //Refrescamos os evntos dos elementos
        element_btn_delete.off('click');
        element_btn_up.off('click');
        element_btn_down.off('click');
        element_offering_name.off('blur');
        element_offering_type.off('change');

        //DELETAR um oferecimento
        element_btn_delete.on('click', function () {
            delete_offering($(this));
        });

        //SUBIR uma prioridade
        element_btn_up.on('click', function () {
            up_priority($(this));
        });

        //BAIXAR uma prioridade
        element_btn_down.on('click', function () {
            dowm_priority($(this));
        });

        //SALVAR o nome
        element_offering_name.on('blur', function () {
            insert_offering($(this));
        });

        //SALVAR o tipo
        element_offering_type.on('change', function () {
            insert_offering($(this));
        });
    }

    /**
     * @Description: Método que ativa botao de 'SUBIR'
     */
    function disableUp() {

        //Temos a linha com prioridade 1
        let first_row = $('.js-div-new-row[data-id-priority=1]');

        //Removemos o atributo 'disabled' dos outros botões
        $('.js-div-new-row[data-id-priority]')
            .find('.js-btn-offering-priority-up')
            .prop('disabled', false);

        //Desativamos o botão 'subir' da primeira prioridade
        first_row
            .find('.js-btn-offering-priority-up')
            .prop('disabled',true);
    }

    /**
     * @Description: Método que ativa botao de 'BAIXAR'
     */
    function disableDown(num_priority) {

        //Temos a linha (oferecimento) passado pelo parámetro
        let last_row = $(`.js-div-new-row[data-id-priority=${num_priority}]`);

        //Removemos o atributo 'disabled' dos outros botões
        $('.js-div-new-row[data-id-priority]')
            .find('.js-btn-offering-priority-down')
            .prop('disabled', false);

        //Desativamos o botão 'baizar' da ultima prioridade
        last_row
            .find('.js-btn-offering-priority-down')
            .prop('disabled',true);

    }

    /**
     * @Descrition: Método que ordena ascendentemente as prioridades dos 'oferecimentos'
     */
    function offering_priorities() {

        //Variavél de control pra obter as prioridades
        var priority_number = 0;

        //Passamos por cada uma das prioridades no momento
        $('.js-container-to-add-elements .js-offering-priority').each(function () {

            //Se incrementa la variable de control
            priority_number++;

            //Atualizamos a numeracao das prioridades
            $(this)
                .parents('.js-div-new-row')
                .attr('data-id-priority', priority_number);

            //Aqui se carga el numero de la prioridad al 'input'
            $(this).val(priority_number);
        });

        //Ativamos as funções que 'ativam/desativam' os botões de 'subir/baixar'
        disableUp();
        disableDown(priority_number);
    }

    /**
     * @Description: Método que procesa a informacao pra INSERTAR no BD
     */
    function insert_offering() {

        //Reordenamos las prioridades
        offering_priorities();

        //Variavel 'array' que guardará cada oferecimento
        var general_array = [];

        //Nós iteramos sobre os elementos (oferecimentos)
        $('.js-container-to-add-elements .js-div-new-row').each(function () {

            //Criamos objeto que guardará a informacao própira de cada oferecimento
            let general_object = {};

            //Obtemos os valores
            let name_field = $(this).find('.js-offering-field-name').val();
            let type_field = $(this).find('.js-offering-field-type').val();
            let number_priority = $(this).find('.js-offering-priority').val();

            //Nós atribuímos os valores ao objeto
            general_object['nome'] = name_field;
            general_object['tipo'] = type_field;
            general_object['prioridade'] = number_priority;

            //Adicionamos o objeto à matriz geral
            general_array.push(general_object);
        });

        //Nós inicializamos variável que armazenará os nomes de cada 'oferecimento'
        var array_name_field = [];

        //Variavél de control pra parar/continuar com o processo
        var control_validation = true;

        //Passamos pela matriz para obter os nomes dos campos (oferecimentos)
        general_array.forEach(function (value, index) {

            //Validamos se o 'nome' do ofererecimento não existe
            if (array_name_field.indexOf(value.nome) === -1){
                //Adcionamos o nome ao array final e habilitamos o botão
                array_name_field.push(value.nome);
                $('.js-btn-offering-add-fields').prop('disabled', false);
            }
            else {
                //Mudamos o valor da variavél de control pra parar o processo e desabilitamos o botão
                control_validation = false;
                $('.js-btn-offering-add-fields').prop('disabled', true);
            }
        });

        //Validamos se existe um campo repetido
        if (control_validation === true)
            //Executamos o ajax que salva os dados no BD
            $.ajax({
                type: 'POST',
                url: FULL_WEB_URL + 'ajax/admin/offerings-crud.php',
                data:{
                    array_data: general_array,
                    action: 'INSERT'
                },
                success: function (response) {

                    //Passamos a resposta para JSON
                    let json_obj = $.parseJSON(response);

                    console.log(json_obj);
                }
            });
        else{
            notify_error_notification('O <b>oferecimento</b> não pode ser repetido.');
            return false;
        }
    }

    /**
     * @Description: Método que deleta o 'oferecimento' do HTML e do BD
     */
    function delete_offering(element) {

        let priority_value = element.parents('.js-container-to-add-elements .js-div-new-row').find('.js-offering-priority').val();

        //Executamos a peticao que deleta o oferecimento
        $.ajax({
            type: 'POST',
            url: FULL_WEB_URL + 'ajax/admin/offerings-crud.php',
            data: {
                priority_value: priority_value,
                action: 'DELETE'
            },
            success: function (response) {

                //Se parsea la respuesta a Json
                let json_obj = $.parseJSON(response);

                //validamos el estado de la operacion
                if (json_obj.status === '200'){

                    //Eliminamos el html correspondiente a la fila
                    element
                        .parents('.js-div-new-row')
                        .hide('slow')
                        .remove()
                        .removeClass('js-div-new-row')
                        .removeAttr('data-id-priority');

                    //Mensaje de exito
                    notify_success_notification(json_obj.message);

                    //Ejecutamos click sobre la flecha para refrescar valores
                    offering_priorities();
                }
                else
                    //Mensaje de error
                    notify_error_notification(json_obj.message);
            }
        });
    }

    /**
     * @Description: Método que move um oferecimento pra 'cima'
     */
    function up_priority(element) {

        //Obtemos a linha que vai-se mover pra cima
        let row_element = element.parents('.js-div-new-row');

        //Movemos o elemento pra a linha que esteja acima dele
        row_element.insertBefore(row_element.prev());

        //Métodos dependentes
        offering_priorities();
        insert_offering();
    }

    /**
     * @Description: Método que move um oferecimento pra 'abaixo'
     */
    function dowm_priority(element) {

        //Obtemos a linha que vai-se mover pra abaixo
        let row_element = element.parents('.js-div-new-row');

        //Movemos o elemento pra a linha que esteja abaixo dele
        row_element.insertAfter(row_element.next());

        //Métodos dependentes
        offering_priorities();
        insert_offering();
    }