
    <?php

    //Importamos los archivos necesarios para el tratamiento de los datos
    require_once(dirname(__FILE__).'/../../security/secure-session.php');
    require_once(dirname(__FILE__).'/../../config-import.php');

    //Obtenemos los datos enviados por el Ajax
    $array_data = filter_input(INPUT_POST, "array_data", FILTER_DEFAULT,FILTER_REQUIRE_ARRAY);
    $priority_value = filter_input(INPUT_POST, 'priority_value', FILTER_SANITIZE_NUMBER_INT, array("options" => array("default" => NULL)));
    $action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING);

    //Validamos el tipo de 'acción'
    if ($action == 'INSERT'){

        // *** Proceso para actualizar las 'prioridades' antes de relaizar cualquier edición ***

        //Obtenemos los datos correspondiente a la tabla 'plantilla_detalle'
        $data_offering = Offerings::getAll(NULL, NULL, NULL, NULL, NULL, NULL, NULL);

        //Creamos variable de control para actualizar las prioridades en caso que existan
        $priority_indicator = 0;

        //Recorremos las plantillas creadas
        foreach ($data_offering as $item){

            //Incrementamos la variable de control por cada iteración
            $priority_indicator++;

            //Actualizamos las prioridades de los 'ofrecimientos' para no alterar el consecutivo de las mismas
            Offerings::updatePriorityOffering($item['id_oferecimento'],$priority_indicator);
        }

        //Realizamos la inserción de los campos de la plantilla en la BD
        $id_oferecimento = Offerings::insertOffering($array_data);

        // *** Fin proceso **

        //Validamos si la inserción tuvo éxito o no
        if ($id_oferecimento != null)
            $response = array(
                'status' => '200',
                'message' => 'Oferecimento Salvado',
                'id_template' => $id_oferecimento
            );
        else
            $response = array(
                'status' => '500',
                'message' => 'Falha al registrar',
                'id_template' => null
            );
    }
    elseif ($action == 'DELETE'){

        //Ejecutamos método que elimina una etiqueta de la Bd
        $delete_tag = Offerings::deleteOffering($priority_value);

        //Validamos si la 'Eliminación' fue correcta
        if ($delete_tag == true)
            $response = array(
                'status' => '200',
                'message' => 'Oferecimento Deletado'
            );
        //elseif ($delete_tag == 'existing_in_users'){
        //    $response = array(
        //        'status' => '500',
        //        'message' => 'Esta Etiqueta, está siendo usada por Usuario.'
        //    );
        //}
        else
            $response = array(
                'status' => '500',
                'message' => 'Falha ao deletar o oferecimento.'
            );
    }

    //Retornamos la respuesta en formato Json
    echo json_encode($response);