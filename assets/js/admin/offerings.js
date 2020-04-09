
    //Variables globales para controlar información
    var element_current_tag = '';

    $(document).ready( function(){

        //Foqueamos el 'nombre de la plantilla' al cargar
        $('.js-template-name').focus();

        //Ejecutamos método para reenderizar 'campos' en forma de etiquetas
        render_tags($('.js-tbody-list-template tr'));
    });

    //Método 'click' que agrega el HTML de un nuevo campo al formulario - (CAMPOS DINÁMICOS)
    $('.js-btn-template-add-fields').on('click', function () {

        //Obtenemos el HTML dentro del contenedor general oculto
        let html_container_add_elements_parent = $('.js-hide-parent-div-add-elements');

        //Agregamos el contenido HTML al 'div' real
        $('.js-container-to-add-elements .js-div-section-add-dinamic-fields').append(html_container_add_elements_parent.html());

        //Ejecutamos funciones dependientes
        execute_funtcions();
        list_priorities();
    });

    //Método 'click' que agrega el HTML de una nueva 'etiqueta' al formulario - (ETIQUETAS)
    $('.js-btn-template-add-tag').on('click', function () {

        //Obtener el html que esta oculto
        let html_container_add_elements_parent = $('.js-hide-parent-div-add-tags');

        //Agregamos el contenido HTML al 'div' real
        $('.js-container-to-add-elements .js-div-section-add-tags').append(html_container_add_elements_parent.html());

        //Ejecutamos funciones dependientes
        execute_funtcions();
        list_priorities();
    });

    //Método 'click' para eliminar una plantilla y sus respectivos 'detalles' (LISTADO TABLA)
    $('.js-btn-delete-template').on('click', function () {

        //Obtenemos el Id de la plantilla a eliminar
        let id_delete_template = $(this).attr('data-delete-id-template');

        //Eliminamos el HTML correspondiente a esta fila
        $(this)
            .parents('.js-tr-parent')
            .hide('slow')
            .remove()
            .removeClass('js-tr-parent');

        //Ejecutamos el Ajax elimina una plantilla
        $.ajax({
            type: 'POST',
            url: FULL_WEB_URL + 'ajax/usuario_sistema/template.php',
            data: {
                template_id: id_delete_template,
                action : 'DELETE'
            },
            success: function (response) {

                //Parseamos la respuesta a Json
                let json_obj = $.parseJSON(response);

                //Validamos estado de la operación
                if (json_obj.status === '200')
                    //Mensaje de éxito
                    notify_success_notification(json_obj.message);
                else
                    //Mensaje de error
                    notify_error_notification(json_obj.message);
            }
        });
    });

    //Ejecutamos método que activa el comportamiento del formulario
    execute_funtcions();

    /**
     * @Description: Método que se llama cada vez que se necesite refrescar el DOM y ejecutar funciones que dependen de otras
     */
    function execute_funtcions() {

        //Ordenamos las prioridades
        //list_priorities;

        //Obtenemos los diferentes elementos del DOM
        let element_field_type = $('.js-template-field-type');
        let element_template_name = $('.js-template-name');
        let element_template_tags = $('.js-template-tag-name');
        let element_field_name = $('.js-template-field-name');
        let element_container_div_form_name_field = $('.js-div-form-name-field');
        let element_btn_up_priority = $('.js-btn-template-priority-up');
        let element_btn_down_priority = $('.js-btn-template-priority-down');
        let element_delete_priority = $('.js-btn-template-priority-delete');
        let element_delete_tag = $('.js-btn-template-delete-tag');


        // ** Seteamos y refrescamos los eventos de los elementos **
        element_field_type.off('change');
        element_template_name.off('blur');
        element_template_tags.off('blur');
        element_field_name.off('blur');
        element_btn_up_priority.off('click');
        element_btn_down_priority.off('click');
        element_delete_priority.off('click');
        element_delete_tag.off('click');

        // ** Asociamos los eventos a los elementos y ejecutamos funciones **

        //Eliminamos los 'Campos Dinámicos' y 'Etiquetas'
        element_delete_priority.on('click', function () {
            delete_field_template($(this));
        });

        element_delete_tag.on('click', function () {
            delete_tag_template($(this));
        });

        //Gauardamos la información por (change-blur), dependiendo el caso

        //--Blur
        element_template_name.on('blur', function () {
            update_template();
        });

        element_field_name.on('blur', function () {
            update_template();
        });

        element_template_tags.on('blur', function () {
            update_template();

            //Agregamos a la variable global el elemento actual '<input>' que se está 'desfoqueando'
            element_current_tag = $(this);
        });

        //--Change
        element_field_type.on('change', function () {

            //Obtenemos el valor seleccionado
            let type_option = $(this).val();

            //Validamos cada uno de los tipos
            if (type_option === 'email'){

                //Mostramos el <input>
                element_container_div_form_name_field.removeClass('css-hide-element');

                //Cargamos el un valor a el 'input'
                $(this)
                    .parents('.js-div-new-row')
                    .find('.js-div-form-name-field')
                    .find('input.js-template-field-name')
                    .val('Correo Electrónico')
                    .focus();
            }
            else if (type_option === 'celular'){

                //Mostramos el <input>
                element_container_div_form_name_field.removeClass('css-hide-element');

                //Cargamos el un valor a el 'input'
                $(this)
                    .parents('.js-div-new-row')
                    .find('.js-div-form-name-field')
                    .find('input.js-template-field-name')
                    .val('Celular')
                    .focus();
            }
            else if (type_option === 'fijo'){

                //Mostramos el <input>
                element_container_div_form_name_field.removeClass('css-hide-element');

                //Cargamos el un valor a el 'input'
                $(this)
                    .parents('.js-div-new-row')
                    .find('.js-div-form-name-field')
                    .find('input.js-template-field-name')
                    .val('Fijo')
                    .focus();
            }
            else if (type_option === 'campo'){

                //Mostramos el <input>
                element_container_div_form_name_field.removeClass('css-hide-element');

                //Cargamos el un valor a el 'input'
                $(this)
                    .parents('.js-div-new-row')
                    .find('.js-div-form-name-field')
                    .find('input.js-template-field-name')
                    .val('')
                    .focus();
            }
        });

        //Subimos la prioridad
        element_btn_up_priority.on('click', function () {
            up_priority($(this));
        });

        //Bajamos la prioridad
        element_btn_down_priority.on('click', function () {
            down_priority($(this));
        });
    }

    /**
     * @Description: Método que se encarga de procesar y registrar los datos en la BD
     */
    function insert_template() {

        //Método que reordena las prioridades
        list_priorities();

        //Obtenemos y validamos el campo 'nombre'
        let element_template_name = $('.js-template-name');

        //Validamos el nombre para evitar guardar espacios en blanco
        let value_template_name = element_template_name.val().trim();

        if (value_template_name === ''){
            element_template_name.addClass('border border-danger');
            return false;
        }
        else
            element_template_name.removeClass('border border-danger');

        //Definimos variable que guardará los campos agregados
        var general_array = [];

        //Recorremos los elementos agregados dinámicamente
        $('.js-container-to-add-elements .js-div-section-add-dinamic-fields .js-div-new-row').each(function () {

            //Creamos objeto para guardar los valores de cada campo agregado que irán a la BD
            let general_object = {};
            let type_field = $(this).find('.js-template-field-type').val();
            let name_field = $(this).find('.js-template-field-name').val();
            let number_priority = $(this).find('.js-template-priority').val();

            //Asignamos los valores al objeto
            general_object['nombre_campo'] = name_field;
            general_object['prioridad'] = number_priority;
            general_object['tipo'] = type_field;

            //Agregamos cada objeto al array general
            general_array.push(general_object);
        });

        //Validamos si hay o no nombres repetidos
        let repeat_names = validate_repeat_names(general_array);

        //Validamos si la variable de control es 'True' para saber si hay o no 'campos' repetidos
        if (repeat_names === true)
            //Ejecutamos Ajax que guarda los datos en la BD
            $.ajax({
                type: 'POST',
                url: FULL_WEB_URL + 'ajax/usuario_sistema/template.php',
                data: {
                    template_name: value_template_name,
                    template_tags: $('.js-template-tags').val(),
                    array_data: general_array,
                    action: 'INSERT'
                }, success: function (response) {

                    //Parseamos la respuesta a Json
                    let json_obj = $.parseJSON(response);

                    //Validamos el estado de la petición
                    if (json_obj.status === '200'){

                        //Cargamos internamente al 'input-hidden' el Id de la nueva plantilla
                        $('.js-hide-template-id').attr('data-id-template', json_obj.id_template);

                        //Obtenemos el elemento del 'nombre_plantilla'
                        let element_template_name = $('.js-template-name');

                        //Seteamos los eventos para que apartir de ahora los cambios sean para 'Editar' y no para 'Guardar'
                        element_template_name.off('blur');
                        element_template_name.blur(update_template);

                    }
                }
            });
        else{
            //Mensaje de error
            notify_error_notification('El <b>Nombre Campo</b> no puede repetirse.');
            return false;
        }
    }

    /**
     * @Description: Método que se encarga de procesar y registrar los datos en la BD
     */
    function update_template() {

        //Método que reordena las prioridades
        list_priorities();

        //Obtenemos y validamos el campo 'nombre' y 'etiquetas'
        let element_template_name = $('.js-template-name');

        //Validamos el nombre para evitar guardar espacios en blanco
        let value_template_name = element_template_name.val().trim();

        if (value_template_name === ''){
            element_template_name.addClass('border border-danger');
            return false;
        }
        else
            element_template_name.removeClass('border border-danger');

        // *** Proceso para procesar y obtener la info. de los 'CAMPOS DINÁMICOS' ***

        //Definimos variable que guardará los campos agregados
        var general_array = [];

        //Recorremos los elementos agregados dinámicamente
        $('.js-container-to-add-elements .js-div-section-add-dinamic-fields .js-div-new-row').each(function () {

            //Creamos objeto para guardar los valores de cada campo agregado que irán a la BD
            let general_object = {};
            let type_field = $(this).find('.js-template-field-type').val();
            let name_field = $(this).find('.js-template-field-name').val();
            let number_priority = $(this).find('.js-template-priority').val();

            //Asignamos los valores al objeto
            general_object['nombre_campo'] = name_field;
            general_object['prioridad'] = number_priority;
            general_object['tipo'] = type_field;

            //Agregamos cada objeto al array general
            general_array.push(general_object);
        });
        // ____ Fin Proceso ____

        // *** Proceso para procesar y obtener la info. de los 'CAMPOS DINÁMICOS' ***

        //Definimos variable que guardará los campos agregados
        var general_array_tags = [];

        //Recorremos los elementos agregados dinámicamente
        $('.js-container-to-add-elements .js-div-section-add-tags .js-div-new-row-tag').each(function () {

            //Creamos objeto para guardar los valores de cada campo agregado que irán a la BD
            let general_object_tags = {};

            //Asignamos los valores al objeto
            general_object_tags['id_tag'] = $(this).find('.js-template-tag-name').attr('data-id-tag');
            general_object_tags['nombre'] = $(this).find('.js-template-tag-name').val();

            //Agregamos cada objeto al array general
            general_array_tags.push(general_object_tags);
        });

        // *** Fin Proceso ***

        //Validamos si hay o no nombres repetidos
        let repeat_names = validate_repeat_names(general_array);
        let repeat_tags = validate_repeat_tags(general_array_tags);

        //Validamos si la variable de control es 'True' para saber si hay o no 'campos' repetidos
        if (repeat_names === true && repeat_tags === true)
            //Ejecutamos Ajax que guarda los datos en la BD
            $.ajax({
                type: 'POST',
                url: FULL_WEB_URL + 'ajax/usuario_sistema/template.php',
                data: {
                    template_id: $('.js-hide-template-id').attr('data-id-template'),
                    template_name: value_template_name,
                    array_data_tags: general_array_tags,
                    array_data: general_array,
                    action: 'UPDATE'
                }, success: function (response) {

                    //Parseamos la respuesta a Json
                    let json_obj = $.parseJSON(response);

                    //Validamos el estado de la petición
                    if (json_obj.status === '200'){

                        //Validamos si el elemento tiene el atributo 'data-id-tag' vacío
                        if (element_current_tag.attr('data-id-tag') === '')
                            //Cargamos a el atributo 'data-id-tag' del elemento '<input>' el 'Id' retornado por la petición
                            element_current_tag.attr('data-id-tag', json_obj.update_template.id_tag);
                    }
                }
            });
        else{
            //Mensaje de error
            notify_error_notification('El <b>Nombre Campo</b> no puede repetirse.');
            return false;
        }
    }

    /**
     * @Description: Método que elimina el HTML del DOM y de la Bd
     */
    function delete_field_template(element) {

        //Obtenemos el valor de la prioridad a eliminar
        let priority_value = element.parents('.js-container-to-add-elements .js-div-section-add-dinamic-fields .js-div-new-row').find('.js-template-priority').val();

        //Eliminamos el HTML correspondiente a esta fila
        element
            .parents('.js-div-new-row')
            .hide('slow')
            .remove()
            .removeClass('js-div-new-row')
            .removeAttr('data-id-priority');

        //Ejecutamos el Ajax elimina el campo de acuerdo a su respectiva prioridad
        $.ajax({
            type: 'POST',
            url: FULL_WEB_URL + 'ajax/usuario_sistema/template.php',
            data: {
                template_id: $('.js-hide-template-id').attr('data-id-template'),
                priority_value : priority_value,
                action : 'DELETE-DETAIL-FIELD'
            },
            success: function (response) {

                //Parseamos la respuesta a Json
                let json_obj = $.parseJSON(response);

                //Validamos estado de la operación
                if (json_obj.status === '200'){

                    //Mensaje de éxito
                    notify_success_notification(json_obj.message);

                    //Ejecutamos click sobre la flecha para refrescar valores
                    list_priorities();
                }
                else
                    //Mensaje de error
                    notify_error_notification(json_obj.message);

                /*if (json_obj=='NOT-DELETE'){
                    validationMessageError('El campo esta siendo usado por un robot');
                }
                else if (json_obj!=false){
                    registrar_plantilla();
                }*/
            }
        });
    }

    /**
     * @Description: Método que elimina el HTML del DOM y de la Bd para una ETIQUETA
     */
    function delete_tag_template(element) {

        //Obtenemos el 'Id' de la 'etiqueta' a eliminar
        let tag_id = element.parents('.js-container-to-add-elements .js-div-section-add-tags .js-div-new-row-tag').find('.js-template-tag-name').attr('data-id-tag');

        //Ejecutamos el Ajax elimina el campo de acuerdo a su respectiva prioridad
        $.ajax({
            type: 'POST',
            url: FULL_WEB_URL + 'ajax/usuario_sistema/template.php',
            data: {
                tag_id: tag_id,
                action : 'DELETE-TAG'
            },
            success: function (response) {

                //Parseamos la respuesta a Json
                let json_obj = $.parseJSON(response);

                //Validamos estado de la operación
                if (json_obj.status === '200'){

                    //Mensaje de éxito
                    notify_success_notification(json_obj.message);

                    //Eliminamos el HTML correspondiente a esta fila
                    element
                        .parents('.js-div-new-row-tag')
                        .hide('slow')
                        .remove()
                        .removeClass('js-div-new-row-tag');
                }
                else
                    //Mensaje de error
                    notify_error_notification(json_obj.message);
            }
        });
    }

    /**
     * @Description: Método que enumera las prioridades de forma ascendente
     */
    function list_priorities() {

        //Declaramos variable de control para enumerar
        var start_number = 0;

        //Recorremos los elementos que hayan en el contenedor general
        $('.js-container-to-add-elements .js-div-section-add-dinamic-fields .js-template-priority').each(function () {

            //Incrementamos la varible inicial
            start_number++;

            //Seteamos y actualizamos la numeración de la propiedad a la 'fila'
            $(this).parents('.js-div-new-row').attr('data-id-priority', start_number);

            //Cargamos el número de la prioridad al '<input>'
            $(this).val(start_number);
        });

        //Ejecutamos funciones que habilitan/deshabilitan botones de subir-bajar
        disable_up_button();
        disable_down_button(start_number);
    }

    /**
     * @Description: Método que inhabilita el uso del botón 'subir' cuando se encuentra en la primer posición
     */
    function disable_up_button() {

        //Obtenemos la fila con prioridad 1
        let first_row = $('.js-div-new-row[data-id-priority=1]');

        //Removemos el atributo 'disabled' a los demás botones de 'subir'
        $('[data-id-priority]').find('.js-btn-template-priority-up').prop('disabled', false);

        //Deshabilitamos el botón 'subir' de la primer prioridad
        first_row.find('.js-btn-template-priority-up').prop('disabled', true);
    }

    /**
     * @Description: Método que inhabilita el uso del botón 'bajar' cuando se encuentra en la última posición
     */
    function disable_down_button(num_priority) {

        //Obtenemos la fila con prioridad pasada por parámetro
        let first_row = $(`.js-div-new-row[data-id-priority=${num_priority}]`);

        //Removemos el atributo 'disabled' a los demás botones de 'subir'
        $('.js-div-new-row[data-id-priority]').find('.js-btn-template-priority-down').prop('disabled', false);

        //Deshabilitamos el botón 'subir' de la primer prioridad
        first_row.find('.js-btn-template-priority-down').prop('disabled', true);
    }

    /**
     * @Description: Método que mueve una fila hacia 'Arriba'
     */
    function up_priority(element) {

        //Obtenemos la fila a mover
        let row_element = element.parents('.js-div-new-row');

        //Movemos el elemento a la posición de la fila que se encuntre arriba
        row_element.insertBefore(row_element.prev());

        //Métodos dependientes
        list_priorities();
        update_template();
    }

    /**
     * @Description: Método que mueve una fila hacia 'Abajo'
     */
    function down_priority(element) {

        //Obtenemos la fila a mover
        let row_element = element.parents('.js-div-new-row');

        //Movemos el elemento a la posición de la fila que se encuntre abajo
        row_element.insertAfter(row_element.next());

        //Métodos dependientes
        list_priorities();
        update_template();
    }

    /**
     * @Description: Método que valida si un campo está repetido o no
     */
    function validate_repeat_names(general_array) {

        //Definimos variable que guardará array con los nombres de las plantillas
        var array_name_field = [];
        var control_validation = true;

        //Recorremos el array para sacar los 'nombres' de los campos
        general_array.forEach(function (value, index) {

            if (array_name_field.indexOf(value.nombre_campo) === -1){
                array_name_field.push(value.nombre_campo);
                $('.js-btn-template-add-fields').prop('disabled', false);
                $('.js-btn-template-add-tag').prop('disabled', false);
            }
            else{
                control_validation = false;
                $('.js-btn-template-add-fields').prop('disabled', true);
                $('.js-btn-template-add-tag').prop('disabled', true);
            }
        });

        //Retornamos la validación
        return control_validation;
    }

    /**
     * @Description: Método que valida si una 'etiqueta' está repetida o no
     */
    function validate_repeat_tags(general_array_tags) {

        //Definimos variable que guardará array con los nombres de las etiquetas
        var array_tag = [];
        var control_validation = true;

        //Recorremos el array para sacar los 'nombres' de los campos
        general_array_tags.forEach(function (value, index) {

            if (array_tag.indexOf(value.nombre) === -1){
                array_tag.push(value.nombre);
                $('.js-btn-template-add-fields').prop('disabled', false);
                $('.js-btn-template-add-tag').prop('disabled', false);
            }
            else{
                control_validation = false;
                $('.js-btn-template-add-fields').prop('disabled', true);
                $('.js-btn-template-add-tag').prop('disabled', true);
            }
        });

        //Retornamos la validación
        return control_validation;
    }

    /**
     * @Description: Método que procesa la información de los campos y los reenderiza como etiquetas
     */
    function render_tags(element_tr) {

        //Recorremos las diferentes filas 'tr' que hayan
        element_tr.each(function () {

            //Guardamos el 'tr' en curso
            let current_container_tr = $(this);

            //Obtenemos y guardamos el 'td'
            let field_tag_td_container = current_container_tr.find('.js-td-tag-fields-template-detail');

            //Obtenemos el texto (contenido) de el <td> 'Campo'
            let text_td_container_tag = current_container_tr.find('.js-td-tag-fields-template-detail').text();

            //Convertimos las diferentes cadenas separadas por (,) en un array
            let array_tag_text = text_td_container_tag.split(',');

            //Eliminamos el 'span' actual del contenedor real
            field_tag_td_container.html('');

            //Recorremos el array con las cadenas a renderizar como etiquetas
            array_tag_text.forEach(function (element, index) {

                let html_hide_container = $('.js-hide-container-report-field-tags').html();

                //Agregamos el 'span' a el '<td>'
                field_tag_td_container.append(html_hide_container);

                //Asignamos valor al 'span' recién agregado con la clase 'js-insert-new-tag'
                field_tag_td_container.find('.js-insert-new-tag').html(element);

                //Removemos la clase 'js-insert-new-tag' del <span> recién agregado para no reemplazar su valor en la siguiente iteración, y de esta forma todos queden repetidos con un mismo texto
                field_tag_td_container.find('.js-insert-new-tag').removeClass('js-insert-new-tag');
            });
        });
    }