
    <?php

    //Importamos los archivos necesarios para el tratamiento de los datos
    require_once(dirname(__FILE__).'/../../security/secure-session.php');
    require_once(dirname(__FILE__).'/../../config-import.php');

    //Obtenemos los datos relevantes para los procesos
    $id_user = Security::GetSessionUserId();
    $id_company = Company::getIdCompany($id_user);

    //Obtenemos los datos enviados por el Ajax
    $template_name = filter_input(INPUT_POST, 'template_name', FILTER_SANITIZE_STRING);
    $array_data_tags = filter_input(INPUT_POST, 'array_data_tags', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);
    $template_id = filter_input(INPUT_POST, 'template_id', FILTER_SANITIZE_NUMBER_INT);
    $tag_id = filter_input(INPUT_POST, 'tag_id', FILTER_SANITIZE_NUMBER_INT);
    $array_data = filter_input(INPUT_POST, "array_data", FILTER_DEFAULT,FILTER_REQUIRE_ARRAY);
    $priority_value = filter_input(INPUT_POST, "priority_value", FILTER_SANITIZE_STRING);
    $action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING);

    //Validamos el tipo de 'acción'
    if ($action == 'INSERT'){

        // *** Proceso para actualizar las 'prioridades' antes de relaizar cualquier edición ***

        //Obtenemos los datos correspondiente a la tabla 'plantilla_detalle'
        $data_template_detail = Template::getAllTemplateDetail(NULL, NULL, NULL, NULL, NULL, NULL, NULL,NULL, $id_company);

        //Creamos variable de control para actualizar las prioridades en caso que existan
        $priority_indicator = 0;

        //Recorremos las plantillas creadas
        foreach ($data_template_detail as $item){

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
    elseif ($action == 'UPDATE'){

        // *** Proceso para actualizar las 'prioridades' antes de relaizar cualquier edición ***

        //Obtenemos los datos correspondiente a la tabla 'plantilla_detalle'
        $data_template_detail = Template::getAllTemplateDetail(NULL, NULL, NULL, NULL, $template_id, NULL, NULL,NULL, $id_company);

        //Creamos variable de control para actualizar las prioridades en caso que existan
        $priority_indicator = 0;

        //Recorremos las plantillas creadas
        foreach ($data_template_detail as $item){

            //Incrementamos la variable de control por cada iteración
            $priority_indicator++;

            //Actualizamos las prioridades de las plantillas para no alterar el consecutivo de las mismas
            Template::updatePriorityTemplateDetail($id_company,$template_id,$item['id_plantilla_detalle'],$priority_indicator);
        }
        // *** Fin proceso **

        //Realizamos la actualización de los campos de la plantilla en la BD
        $update_template = Template::updateTemplate($id_company, $template_id, $template_name,$array_data, $array_data_tags);

        //Validamos si la actualización tuvo éxito o no
        if ($update_template != null)
            $response = array(
                'status' => '200',
                'message' => 'Plantilla Actualizada',
                'update_template' => $update_template
            );
        else
            $response = array(
                'status' => '500',
                'message' => 'Error al actualizar',
                'update_template' => null
            );
    }
    elseif ($action == 'DELETE'){

        //Eliminamos la plantilla junto a sus respectivos 'plantilla_detalle'
        $delete_template = Template::deleteTemplate($template_id,$id_company);

        //Validamos éxito de la operación
        if ($delete_template)
            $response = array(
                'status' => '200',
                'message' => 'Plantilla Eliminada'
            );
        else
            $response = array(
                'status' => '500',
                'message' => 'Error al eliminar'
            );
    }
    elseif ($action == 'DELETE-DETAIL-FIELD'){

        //Ejecutamos método que elimina el campo en la Bd de una prioridad específica en 'plantilla_detalle'
        $delete_template_detail = Template::deleteTemplateDetail($id_company, $priority_value, $template_id);

        //Validamos éxito de la operación
        if ($delete_template_detail)
            $response = array(
                'status' => '200',
                'message' => 'Campo Eliminado'
            );
        else
            $response = array(
                'status' => '500',
                'message' => 'Error al eliminar'
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