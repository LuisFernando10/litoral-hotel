
    <?php

    //Importamos los archivos necesarios para el tratamiento de los datos
    require_once(dirname(__FILE__).'/../../security/secure-session.php');
    require_once(dirname(__FILE__).'/../../config-import.php');

    //Obtenemos los datos enviados por el Ajax
    $tag_id = filter_input(INPUT_POST, 'tag_id', FILTER_SANITIZE_NUMBER_INT, array("options" => array("default" => NULL)));
    $array_data = filter_input(INPUT_POST, "array_data", FILTER_DEFAULT,FILTER_REQUIRE_ARRAY);
    $priority_value = filter_input(INPUT_POST, "priority_value", FILTER_SANITIZE_NUMBER_INT);
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

            //Actualizamos las prioridades de las plantillas para no alterar el consecutivo de las mismas
            Template::updatePriorityTemplateDetail($id_company,$item['id_plantilla'],$item['id_plantilla_detalle'],$priority_indicator);
        }

        //Realizamos la inserción de los campos de la plantilla en la BD
        $id_template = Template::insertTemplate($id_company, $template_name, $array_data);

        // *** Fin proceso **

        //Validamos si la inserción tuvo éxito o no
        if ($id_template != null)
            $response = array(
                'status' => '200',
                'message' => 'Plantilla Registrada',
                'id_template' => $id_template
            );
        else
            $response = array(
                'status' => '500',
                'message' => 'Error al registrar',
                'id_template' => null
            );
    }
    elseif ($action == 'DELETE-TAG'){

        //Ejecutamos método que elimina una etiqueta de la Bd
        $delete_tag = Tag::validate_delete_tag($tag_id,$id_company);

        //Validamos si la 'Eliminación' fue correcta
        if ($delete_tag == true)
            $response = array(
                'status' => '200',
                'message' => 'Etiqueta Eliminada'
            );
        elseif ($delete_tag == 'existing_in_users'){
            $response = array(
                'status' => '500',
                'message' => 'Esta Etiqueta, está siendo usada por Usuario.'
            );
        }
        elseif ($delete_tag == 'existing_in_campaing'){
            $response = array(
                'status' => '500',
                'message' => 'Esta Etiqueta, está siendo usada por una Campaña.'
            );
        }
        else
            $response = array(
                'status' => '500',
                'message' => 'Error al eliminar la Etiqueta.'
            );
    }

    //Retornamos la respuesta en formato Json
    echo json_encode($response);